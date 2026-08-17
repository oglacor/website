<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Password reset tokens.
 *
 * The raw token is returned once, by issueFor(), and never stored — only its
 * SHA-256. Lookups hash the incoming token and compare, so a leaked table is
 * useless to an attacker.
 *
 * Note the method names: CI4's base Model reserves get()/set() as query-builder
 * methods and a signature mismatch is a fatal error at call time, not a lint
 * error (see CLAUDE.md rule 8). Hence issueFor()/findValid()/consume().
 */
class PasswordResetModel extends Model
{
    protected $table            = 'password_resets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'token_hash', 'expires_at', 'used_at'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    // Disabled with '' — never false. See CLAUDE.md rule 5.
    protected $updatedField     = '';

    /**
     * How long a reset link stays valid. Short on purpose: long enough to walk
     * to your inbox, short enough that a link sitting in a mailbox or a proxy
     * log stops being a key fairly quickly.
     */
    public const TTL_MINUTES = 60;

    /**
     * Issues a fresh token for a user and returns the RAW token, which is the
     * only time it exists in plaintext. Any outstanding tokens for that user
     * are revoked first, so requesting a second link invalidates the first —
     * otherwise every request would leave another working key in circulation.
     */
    public function issueFor(int $userId): string
    {
        $this->revokeAllFor($userId);

        $token = bin2hex(random_bytes(32));

        $this->insert([
            'user_id'    => $userId,
            'token_hash' => hash('sha256', $token),
            'expires_at' => date('Y-m-d H:i:s', time() + (self::TTL_MINUTES * 60)),
            'used_at'    => null,
        ]);

        return $token;
    }

    /**
     * Returns the row for a token that is genuinely usable — exists, unused,
     * and unexpired — or null. All three conditions are checked here rather
     * than in the controller so no caller can accidentally skip one.
     */
    public function findValid(string $token): ?array
    {
        if ($token === '') {
            return null;
        }

        $row = $this->where('token_hash', hash('sha256', $token))
            ->where('used_at', null)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->first();

        return $row ?: null;
    }

    /**
     * Marks a token spent. Called only after the password has actually been
     * changed, so a failed reset doesn't burn the user's link.
     */
    public function consume(int $id): void
    {
        $this->update($id, ['used_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Revokes every outstanding token for a user by marking them spent.
     */
    public function revokeAllFor(int $userId): void
    {
        // Query builder directly rather than the Model's own update(): this is
        // a bulk UPDATE with no single primary key, and going through the
        // builder sidesteps any ambiguity around Model::set() (CLAUDE.md rule 8).
        $this->builder()
            ->where('user_id', $userId)
            ->where('used_at', null)
            ->update(['used_at' => date('Y-m-d H:i:s')]);
    }
}
