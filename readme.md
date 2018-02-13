# HTML Data Extraction Tool
This tool is for extracting data from HTML tables and inserting the data into an SQL database.

## Installation & Usage
### Installation
To install simply download the file and put it into your HTML/Public folder on your LAMP Server.

### Usage
The form is pretty straight forward. Just note that tag input will usually simply be the TD tags and that any special cases (<td valign="top") will need the quotes to be escaped (<td valign=\\"top\\"). If you are running into SQL errors you can uncomment the echo SQL and echo SQL Error lines.

## MIT License
Copyright 2018 Isaac Dew

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.