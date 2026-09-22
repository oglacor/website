#!/usr/bin/env bash
#
# copy-uploads.sh — the Linux/cPanel twin of copy-uploads.ps1.
#
# Copies ONLY the legacy media files the imported blog posts reference (listed in
# files.txt) into public/assets/uploads/, keeping the year/month folders.
#
# Run it on the server, from anywhere:
#
#     bash wp-import/copy-uploads.sh ~/wp-old/wp-content/uploads
#
# (the old site's uploads are in ~/public_html/wp-content/uploads until DEPLOY.md step 2.2
#  moves the old site to ~/wp-old). Anything it can't find is written to missing.txt.

set -u

SRC="${1:?usage: copy-uploads.sh /path/to/old/wp-content/uploads [dest]}"
HERE="$(cd "$(dirname "$0")" && pwd)"
DEST="${2:-$HERE/../public/assets/uploads}"
LIST="$HERE/files.txt"

[ -d "$SRC" ]  || { echo "Source folder not found: $SRC" >&2; exit 1; }
[ -f "$LIST" ] || { echo "File list not found: $LIST" >&2; exit 1; }

copied=0
missing=0
: > "$HERE/missing.txt"

while IFS= read -r rel || [ -n "$rel" ]; do
    rel="${rel%$'\r'}"
    [ -z "$rel" ] && continue

    if [ -f "$SRC/$rel" ]; then
        mkdir -p "$DEST/$(dirname "$rel")"
        cp -p "$SRC/$rel" "$DEST/$rel"
        copied=$((copied + 1))
    else
        echo "$rel" >> "$HERE/missing.txt"
        missing=$((missing + 1))
    fi
done < "$LIST"

echo ""
echo "Copied  : $copied of $((copied + missing))"
if [ "$missing" -gt 0 ]; then
    echo "Missing : $missing  ->  $HERE/missing.txt"
else
    rm -f "$HERE/missing.txt"
    echo "Missing : 0  - every referenced file was found."
fi
echo "Dest    : $DEST"
echo ""
