#!/usr/bin/env python3
import re
import os
import sys
import urllib.request
import json

def parse_version(v_str):
    return tuple(int(x) for x in v_str.strip().split('.') if x.isdigit())

def main():
    readme_path = 'readme.txt'
    if not os.path.exists(readme_path):
        print(f"Error: {readme_path} not found in current directory.")
        sys.exit(1)

    # 1. Read readme.txt and find current "Tested up to" version
    with open(readme_path, 'r', encoding='utf-8') as f:
        content = f.read()

    match = re.search(r'Tested up to:\s*([0-9.]+)', content)
    if not match:
        print("Error: Could not find 'Tested up to' header in readme.txt")
        sys.exit(1)

    current_version_str = match.group(1)
    current_version = parse_version(current_version_str)
    print(f"Current 'Tested up to' version in readme.txt: {current_version_str}")

    # 2. Fetch the latest stable WordPress version
    url = "https://api.wordpress.org/core/version-check/1.7/"
    try:
        with urllib.request.urlopen(url, timeout=10) as response:
            data = json.loads(response.read().decode('utf-8'))
    except Exception as e:
        print(f"Error fetching WordPress version: {e}")
        sys.exit(1)

    offers = data.get('offers', [])
    if not offers:
        print("Error: No WordPress version offers found in API response.")
        sys.exit(1)

    # Typically offers[0] is the latest stable version
    latest_version_str = offers[0].get('version')
    if not latest_version_str:
        print("Error: Could not find version string in API response.")
        sys.exit(1)

    latest_version = parse_version(latest_version_str)
    print(f"Latest stable WordPress version from API: {latest_version_str}")

    # 3. Compare and update if needed
    if latest_version > current_version:
        new_content = re.sub(
            r'(Tested up to:\s*)[0-9.]+',
            rf'\g<1>{latest_version_str}',
            content
        )
        with open(readme_path, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Updated readme.txt 'Tested up to' to {latest_version_str}")

        # Set GitHub Actions output
        if 'GITHUB_OUTPUT' in os.environ:
            with open(os.environ['GITHUB_OUTPUT'], 'a') as go:
                go.write("updated=true\n")
                go.write(f"wp_version={latest_version_str}\n")
    else:
        print("No update needed. Plugin is already tested up to the latest WordPress version.")
        if 'GITHUB_OUTPUT' in os.environ:
            with open(os.environ['GITHUB_OUTPUT'], 'a') as go:
                go.write("updated=false\n")

if __name__ == '__main__':
    main()
