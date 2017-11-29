# Introduction
This GitHub project is an initiative of WoodWing Software. 
It provides a simple framework to write and publish technical documentation 
for the Enterprise system. Through this channel WoodWing engineers can 
update partners and integrators with technical information helping them 
to integrate their own solutions with Enterprise. 

## Installation
This GitHub project is using Jekyll and is ran by the GitHub Pages server. 
For maintance and testing, you can run it locally as decribed 
[here](https://help.github.com/articles/setting-up-your-github-pages-site-locally-with-jekyll/) 
before you push your changes to Git.

## Maintenance
This project provides a simple documentation structure. It uses the MarkDown
standard to take away the clutter of the HTML notation. It offers a generator 
for the Table Of Contents which hyperlinks that are automatically updated. 
This makes it easy to add, update, delete or move guides, sections and chapters.
How this is organised is explained in the chapter below.

# Documentation structure
## Guides
At the root level of this project there are folders. 
Each folder reprensents a guide. A guide can be seen as a book. 
In the folder of a guide there must be an index.md file.
This is the landing page of the guide. 
The front matter of this page must have the follow attributes:
```markdown
layout: guide
title: <the title of the guide>
```
The `layout` property is used to select the HTML page. In this 
case the `_layouts/guide.html` page is applied.  

## Sections
A guide may have many chapters. Those may be bundled in sections. 
To add a section to a guide, simply create a subfolder in the guide's 
folder and add an index.md file with the folliwng front matter:
```markdown
layout: section
title: <title of the section>
``` 
The `layout` property is used to select the HTML page. In this 
case the `_layouts/section.html` page is applied.  

## Chapters
Chapters can be added to a guide or to the section of a guide. 
For each chapter a markdown file/page should be added to the folder 
of the guide or the section. 
The front matter of this page must have the follow attributes: 
```markdown
layout: chapter
title: <title of the chapter>
sortid: <number representing the order within the folder>
```  
The `sortid` gives control over the position the chapter is shown 
in the Table Of Contents. Chapters are sorted per folder whereby the 
the chapter with lowest number is shown first.
The `layout` property is used to select the HTML page. In this 
case the `_layouts/chapter.html` page is applied.  

## Table Of Contents
The TOC can be generated. This is needed after making structural 
changes to the guide, such as adding chapters to moving files. 
To generate the TOC please enter the following commands at the shell prompt:
```
$ cd <this_project_folder>/_build
$ php generate.php
```
For each guide a TOC is generated at `_data/<guide>/toc.yaml`. 
This YAML file is read by `_includes/toc.htm` to compose a HTML 
variant and injected by the layout pages by a simple include 
instruction `{% include /toc.html %}`.

## Search
There is a Google-like search feature provided that is based on [Lunr](https://lunrjs.com/).
It is entirely written in JavaScript and uses a search index file. 
To generate the search index file please enter the following commands at the shell prompt:
```
$ cd <this_project_folder>/_build
$ php generate.php
```
For each guide, the generator reads all text content from the Markdown files/pages and adds one 
record for each file/page in the index file. For each guide a search index file is generated at 
`assets/<guide>/search_data.json`. The index file is downloaded by JavaScript as executed 
by the search page. 
Whenever you change text content of a guide, the generator should be executed to reflect 
those changes in the search results.