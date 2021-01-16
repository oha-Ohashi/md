#!/usr/bin/env python
# this script on only PYTHON3
import urllib.request
import urllib.parse
with open('test.md','br') as file:
    data = file.read()
request = urllib.request.Request('https://api.github.com/markdown/raw')
request.add_header('Content-Type','text/plain')
f = urllib.request.urlopen(request,data)
with open('index.html','bw') as file:
    file.write(f.read())
