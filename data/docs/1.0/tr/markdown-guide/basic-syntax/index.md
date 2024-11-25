
# Basic Syntax

Nearly all Markdown parsers support the basic syntax outlined in the original Markdown design document. There are minor variations and discrepancies between Markdown processors — those are noted inline wherever possible. 

Olodoc uses the <a href="https://packagist.org/packages/erusev/parsedown-extra">parsedown-extra</a> php package when parsing your <b>.md</b> files.

## Headings

To create a heading, add number signs (#) in front of a word or phrase. The number of number signs you use should correspond to the heading level. For example, to create a heading level three (h3), use three number signs (e.g., ### My Header).

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code># Heading level 1</code></td>
      <td><code>&lt;h1&gt;Heading level 1&lt;/h1&gt;</code></td>
      <td><h1>Heading level 1</h1></td>
    </tr>
    <tr>
      <td><code>## Heading level 2</code></td>
      <td><code>&lt;h2&gt;Heading level 2&lt;/h2&gt;</code></td>
      <td><h2>Heading level 2</h2></td>
    </tr>
    <tr>
      <td><code>### Heading level 3</code></td>
      <td><code>&lt;h3&gt;Heading level 3&lt;/h3&gt;</code></td>
      <td><h3>Heading level 3</h3></td>
    </tr>
    <tr>
      <td><code>#### Heading level 4</code></td>
      <td><code>&lt;h4&gt;Heading level  4&lt;/h4&gt;</code></td>
      <td><h4>Heading level 4</h4></td>
    </tr>
    <tr>
      <td><code>##### Heading level 5</code></td>
      <td><code>&lt;h5&gt;Heading level 5&lt;/h5&gt;</code></td>
      <td><h5>Heading level 5</h5></td>
    </tr>
    <tr>
      <td><code>###### Heading level 6</code></td>
      <td><code>&lt;h6&gt;Heading level 6&lt;/h6&gt;</code></td>
      <td><h6>Heading level 6</h6></td>
    </tr>
  </tbody>
</table>

## Paragraphs

To create paragraphs, use a blank line to separate one or more lines of text.

> If you need to indent paragraphs in the output, see the section on how to indent (tab).

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <code>
          I really like using Markdown.<br><br>

          I think I'll use it to format all of my documents from now on.
        </code>
      </td>
      <td>
        <code>&lt;p&gt;I really like using Markdown.&lt;/p&gt;<br><br>

        &lt;p&gt;I think I'll use it to format all of my documents from now on.&lt;/p&gt;</code>
      </td>
      <td>
        <p>I really like using Markdown.</p>

        <p>I think I'll use it to format all of my documents from now on.</p>
      </td>
    </tr>
  </tbody>
</table>

## Line Breaks

To create a line break or new line (<b>&lt;br&gt;</b>), end a line with two or more spaces, and then type return.

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <code>
          This is the first line. &nbsp;<br>
          And this is the second line.
        </code>
      </td>
      <td>
        <code>&lt;p&gt;This is the first line.&lt;br&gt;<br>

        And this is the second line.&lt;/p&gt;</code>
      </td>
      <td>
        <p>This is the first line.<br>   
        And this is the second line.</p>
      </td>
    </tr>
  </tbody>
</table>

## Emphasis

You can add emphasis by making text bold or italic.

### Bold

To bold text, add two asterisks or underscores before and after a word or phrase. To bold the middle of a word for emphasis, add two asterisks without spaces around the letters.

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>I just love **bold text**.</code></td>
      <td><code>I just love &lt;strong&gt;bold text&lt;/strong&gt;.</code></td>
      <td>I just love <strong>bold text</strong>.</td>
    </tr>
    <tr>
      <td><code>I just love __bold text__.</code></td>
      <td><code>I just love &lt;strong&gt;bold text&lt;/strong&gt;.</code></td>
      <td>I just love <strong>bold text</strong>.</td>
    </tr>
    <tr>
      <td><code>Love**is**bold</code></td> <td><code>Love&lt;strong&gt;is&lt;/strong&gt;bold</code></td>
      <td>Love<strong>is</strong>bold</td>
    </tr>
  </tbody>
</table>

### Italic

To italicize text, add one asterisk or underscore before and after a word or phrase. To italicize the middle of a word for emphasis, add one asterisk without spaces around the letters.

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>Italicized text is the *cat's meow*.</code></td>
      <td><code>Italicized text is the &lt;em&gt;cat's meow&lt;/em&gt;.</code></td>
      <td>Italicized text is the <em>cat’s meow</em>.</td>
    </tr>
    <tr>
      <td><code>Italicized text is the _cat's meow_.</code></td>
      <td><code>Italicized text is the &lt;em&gt;cat's meow&lt;/em&gt;.</code></td>
      <td>Italicized text is the <em>cat’s meow</em>.</td>
    </tr>
    <tr>
      <td><code>A*cat*meow</code></td>
      <td><code>A&lt;em&gt;cat&lt;/em&gt;meow</code></td>
      <td>A<em>cat</em>meow</td>
    </tr>
  </tbody>
</table>

### Bold and Italic

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>This text is ***really important***.</code></td>
      <td><code>This text is &lt;em&gt;&lt;strong&gt;really important&lt;/strong&gt;&lt;/em&gt;.</code></td>
      <td>This text is <em><strong>really important</strong></em>.</td>
    </tr>
    <tr>
      <td><code>This text is ___really important___.</code></td>
      <td><code>This text is &lt;em&gt;&lt;strong&gt;really important&lt;/strong&gt;&lt;/em&gt;.</code></td>
      <td>This text is <em><strong>really important</strong></em>.</td>
    </tr>
    <tr>
      <td><code>This text is __*really important*__.</code></td>
      <td><code>This text is &lt;em&gt;&lt;strong&gt;really important&lt;/strong&gt;&lt;/em&gt;.</code></td>
      <td>This text is <em><strong>really important</strong></em>.</td>
    </tr>
    <tr>
      <td><code>This text is **_really important_**.</code></td>
      <td><code>This text is &lt;em&gt;&lt;strong&gt;really important&lt;/strong&gt;&lt;/em&gt;.</code></td>
      <td>This text is <em><strong>really important</strong></em>.</td>
    </tr>
    <tr>
      <td><code>This is really***very***important text.</code></td>
      <td><code>This is really&lt;em&gt;&lt;strong&gt;very&lt;/strong&gt;&lt;/em&gt;important text.</code></td>
      <td>This is really<em><strong>very</strong></em>important text.</td>
    </tr>
  </tbody>
</table>

### Blockquotes

To create a blockquote, add a > in front of a paragraph.

```sh
> Dorothy followed her through many of the beautiful rooms in her castle.
```

The rendered output looks like this:

> Dorothy followed her through many of the beautiful rooms in her castle.

### Blockquotes with Multiple Paragraphs

Blockquotes can contain multiple paragraphs. Add a > on the blank lines between the paragraphs.

```sh
> Dorothy followed her through many of the beautiful rooms in her castle.
>
> The Witch bade her clean the pots and kettles and sweep the floor and keep the fire fed with wood.
```

The rendered output looks like this:

Dorothy followed her through many of the beautiful rooms in her castle.

The Witch bade her clean the pots and kettles and sweep the floor and keep the fire fed with wood.

### Nested Blockquotes

Blockquotes can be nested. Add a >> in front of the paragraph you want to nest.

```sh
> Dorothy followed her through many of the beautiful rooms in her castle.
>
>> The Witch bade her clean the pots and kettles and sweep the floor and keep the fire fed with wood.
```

The rendered output looks like this:

> Dorothy followed her through many of the beautiful rooms in her castle.
>
>> The Witch bade her clean the pots and kettles and sweep the floor and keep the fire fed with wood.

### Blockquotes with Other Elements

Blockquotes can contain other Markdown formatted elements. Not all elements can be used — you’ll need to experiment to see which ones work.

```sh
> #### The quarterly results look great!
>
> - Revenue was off the chart.
> - Profits were higher than ever.
>
>  *Everything* is going according to **plan**.
```

The rendered output looks like this:

> #### The quarterly results look great!
>
> - Revenue was off the chart.
> - Profits were higher than ever.
>
>  *Everything* is going according to **plan**.

## Lists

You can organize items into ordered and unordered lists.

### Ordered Lists

To create an ordered list, add line items with numbers followed by periods. The numbers don’t have to be in numerical order, but the list should start with the number one.

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td>
      <code>
        1. First item<br>
        2. Second item<br>
        3. Third item<br>
        4. Fourth item
      </code>
    </td>
    <td>
      <code>
        &lt;ol&gt;<br>
          &nbsp;&nbsp;&lt;li&gt;First item&lt;/li&gt;<br>
          &nbsp;&nbsp;&lt;li&gt;Second item&lt;/li&gt;<br>
          &nbsp;&nbsp;&lt;li&gt;Third item&lt;/li&gt;<br>
          &nbsp;&nbsp;&lt;li&gt;Fourth item&lt;/li&gt;<br>
        &lt;/ol&gt;
      </code>
    </td>
    <td>
      <ol>
        <li>First item</li>
        <li>Second item</li>
        <li>Third item</li>
        <li>Fourth item</li>
      </ol>
    </td>
    </tr>
    <tr>
      <td>
        <code>
          1. First item<br>
          1. Second item<br>
          1. Third item<br>
          1. Fourth item
        </code>
      </td>
      <td>
        <code>
          &lt;ol&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;First item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Second item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Third item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Fourth item&lt;/li&gt;<br>
          &lt;/ol&gt;
        </code>
      </td>
      <td>
        <ol>
          <li>First item</li>
          <li>Second item</li>
          <li>Third item</li>
          <li>Fourth item</li>
        </ol>
      </td>
    </tr>
    <tr>
      <td>
        <code>
          1. First item<br>
          8. Second item<br>
          3. Third item<br>
          5. Fourth item
        </code>
      </td>
      <td>
        <code>
          &lt;ol&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;First item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Second item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Third item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Fourth item&lt;/li&gt;<br>
          &lt;/ol&gt;
        </code>
      </td>
      <td>
        <ol>
          <li>First item</li>
          <li>Second item</li>
          <li>Third item</li>
          <li>Fourth item</li>
        </ol>
      </td>
    </tr>
    <tr>
      <td>
        <code>
          1. First item<br>
          2. Second item<br>
          3. Third item<br>
          &nbsp;&nbsp;&nbsp;&nbsp;1. Indented item<br>
          &nbsp;&nbsp;&nbsp;&nbsp;2. Indented item<br>
          4. Fourth item
        </code>
      </td>
      <td>
        <code>
          &lt;ol&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;First item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Second item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Third item<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&lt;ol&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;li&gt;Indented item&lt;/li&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;li&gt;Indented item&lt;/li&gt;<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&lt;/ol&gt;<br>
            &nbsp;&nbsp;&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Fourth item&lt;/li&gt;<br>
          &lt;/ol&gt;
        </code>
      </td>
      <td>
        <ol>
          <li>First item</li>
          <li>Second item</li>
          <li>Third item
            <ol>
              <li>Indented item</li>
              <li>Indented item</li>
            </ol>
          </li>
          <li>Fourth item</li>
        </ol>
      </td>
    </tr>
  </tbody>
</table>

### Unordered Lists

To create an unordered list, add dashes (-), asterisks (\*), or plus signs (+) in front of line items. Indent one or more items to create a nested list.

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <code>
          - First item<br>
          - Second item<br>
          - Third item<br>
          - Fourth item
        </code>
      </td>
      <td>
        <code>
          &lt;ul&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;First item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Second item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Third item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Fourth item&lt;/li&gt;<br>
          &lt;/ul&gt;
        </code>
      </td>
      <td>
        <ul>
          <li>First item</li>
          <li>Second item</li>
          <li>Third item</li>
          <li>Fourth item</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td>
        <code>
          * First item<br>
          * Second item<br>
          * Third item<br>
          * Fourth item
        </code>
      </td>
      <td>
        <code>
          &lt;ul&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;First item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Second item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Third item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Fourth item&lt;/li&gt;<br>
          &lt;/ul&gt;
        </code>
      </td>
      <td>
        <ul>
          <li>First item</li>
          <li>Second item</li>
          <li>Third item</li>
          <li>Fourth item</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td>
        <code>
          + First item<br>
          + Second item<br>
          + Third item<br>
          + Fourth item
        </code>
      </td>
      <td>
        <code>
          &lt;ul&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;First item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Second item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Third item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Fourth item&lt;/li&gt;<br>
          &lt;/ul&gt;
        </code>
      </td>
      <td>
        <ul>
          <li>First item</li>
          <li>Second item</li>
          <li>Third item</li>
          <li>Fourth item</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td>
        <code>
          - First item<br>
          - Second item<br>
          - Third item<br>
          &nbsp;&nbsp;&nbsp;&nbsp;- Indented item<br>
          &nbsp;&nbsp;&nbsp;&nbsp;- Indented item<br>
          - Fourth item
        </code>
      </td>
      <td>
        <code>
          &lt;ul&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;First item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Second item&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Third item<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&lt;ul&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;li&gt;Indented item&lt;/li&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;li&gt;Indented item&lt;/li&gt;<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&lt;/ul&gt;<br>
            &nbsp;&nbsp;&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;Fourth item&lt;/li&gt;<br>
          &lt;/ul&gt;
        </code>
      </td>
      <td>
        <ul>
          <li>First item</li>
          <li>Second item</li>
          <li>Third item
            <ul>
              <li>Indented item</li>
              <li>Indented item</li>
            </ul>
          </li>
          <li>Fourth item</li>
        </ul>
      </td>
    </tr>
  </tbody>
</table>


### Starting Unordered List Items With Numbers

If you need to start an unordered list item with a number followed by a period, you can use a backslash (\) to escape the period.

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <code>
          - 1968\. A great year!<br>
          - I think 1969 was second best.
        </code>
      </td>
      <td>
        <code>
          &lt;ul&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;1968. A great year!&lt;/li&gt;<br>
            &nbsp;&nbsp;&lt;li&gt;I think 1969 was second best.&lt;/li&gt;<br>
          &lt;/ul&gt;
        </code>
      </td>
      <td>
        <ul>
          <li>1968. A great year!</li>
          <li>I think 1969 was second best.</li>
        </ul>
      </td>
    </tr>
  </tbody>
</table>

### Adding Elements in Lists

To add another element in a list while preserving the continuity of the list, indent the element four spaces or one tab, as shown in the following examples.

#### Paragraphs

```md
* This is the first list item.
* Here's the second list item.

    I need to add another paragraph below the second list item.

* And here's the third list item.
```

The rendered output looks like this:

* This is the first list item.
* Here's the second list item.

    I need to add another paragraph below the second list item.

* And here's the third list item.

#### Blockquotes

```md
* This is the first list item.
* Here's the second list item.

    > A blockquote would look great below the second list item.

* And here's the third list item.
The rendered output looks like this:
```

The rendered output looks like this:

* This is the first list item.
* Here's the second list item.

    > A blockquote would look great below the second list item.

* And here's the third list item.
The rendered output looks like this:

#### Code Blocks

For code blocks, use 3 times backtick (<kbd>`</kbd>). When they are in a list, indent them eight spaces or two tabs.

1. Open the file.
2. Find the following code block on line 21:

    ```html
    \```html
      <html>
      <head>
        <title>Test</title>
      </head>
    \```
    ```

3. Update the title to match the name of your website.
```

The rendered output looks like this:


1. Open the file.
2. Find the following code block on line 21:

    ```html
      <html>
      <head>
        <title>Test</title>
      </head>
    ```

3. Update the title to match the name of your website.
```

#### Images

```sh
1. Open the file containing the Linux mascot.
2. Marvel at its beauty.

    ![Tux, the Linux mascot](/images/tux.png)

3. Close the file.
```

The rendered output looks like this:

1. Open the file containing the Linux mascot.
2. Marvel at its beauty.

    ![Tux, the Linux mascot](/images/tux.png)

3. Close the file.


#### Lists

You can nest an unordered list in an ordered list, or vice versa.

```md
1. First item
2. Second item
3. Third item
    - Indented item
    - Indented item
4. Fourth item
```

The rendered output looks like this:

1. First item
2. Second item
3. Third item
    - Indented item
    - Indented item
4. Fourth item

## Horizontal Rules

To create a horizontal rule, use three or more asterisks (\*\*\*), dashes (\---),  or underscores (\___) on a line by themselves.

```sh
***

---

_________________
```

The rendered output of all three looks identical:

***

## Links

To create a link, enclose the link text in brackets (e.g., [Duck Duck Go]) and then follow it immediately with the URL in parentheses (e.g., (https://duckduckgo.com)).

```sh
My favorite search engine is [Duck Duck Go](https://duckduckgo.com).
```

The rendered output looks like this:

My favorite search engine is [Duck Duck Go](https://duckduckgo.com).

> [!NOTE]
> To link to an element on the same page, see <a href="https://www.markdownguide.org/extended-syntax/#linking-to-heading-ids" target="_blank">linking to heading IDs</a>. To create a link that opens in a new tab or window, see the section on <a href="https://www.markdownguide.org/hacks/#link-targets" target="_blank">link targets</a>.

### Adding Titles

You can optionally add a title for a link. This will appear as a tooltip when the user hovers over the link. To add a title, enclose it in quotation marks after the URL.

```sh
My favorite search engine is [Duck Duck Go](https://duckduckgo.com "The best search engine for privacy").
```

The rendered output looks like this:

My favorite search engine is [Duck Duck Go](https://duckduckgo.com "The best search engine for privacy").

[You can use numbers for reference-style link definitions][1]


### Relative Links

If your relative link contains folders you can write it like below.

```sh
[link text](subfolder/subsubfolder/relevantfolder/)
```

If the desired file is not in any folder or subfolder the link is simply:

```sh
[link text](README.md)
```

### Reference Links

```sh
Welcome to the demo of Parsedown Extra [^1]:

[^1]: [Parsedown Extra](https://github.com/erusev/parsedown-extra) is an extension of [Parsedown](/) that adds support for [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/).
```

The rendered output looks like this:

Welcome to the demo of Parsedown Extra [^1]:

[^1]: [Parsedown Extra](https://github.com/erusev/parsedown-extra) is an extension of [Parsedown](/) that adds support for [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/).


## Images

To add an image, add an exclamation mark (!), followed by alt text in brackets, and the path or URL to the image asset in parentheses. You can optionally add a title in quotation marks after the path or URL.

```
![Tux, the Linux mascot](/images/tux.png)
```

The rendered output looks like this:

![Tux, the Linux mascot](/images/tux.png)

### Linking Images

To add a link to an image, enclose the Markdown for the image in brackets, and then add the link in parentheses.

```sh
[![Tux, the Linux mascot](/images/tux.png "Tux, the Linux mascot")](https://en.wikipedia.org/wiki/Tux_(mascot))
```

The rendered output looks like this:

[![Tux, the Linux mascot](/images/tux.png "Tux, the Linux mascot")](https://en.wikipedia.org/wiki/Tux_(mascot))


## Escaping Characters

To display a literal character that would otherwise be used to format text in a Markdown document, add a backslash (\) in front of the character.

* This an example list without backslash.

With backslash the rendered output looks like this:

\\* Without the backslash, this would be a bullet in an unordered list.

### Characters You Can Escape

You can use a backslash to escape the following characters.

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Character</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>\</td>
      <td>backslash</td>
    </tr>
    <tr>
      <td>`</td>
      <td>backtick</td>
    </tr>
    <tr>
      <td>*</td>
      <td>asterisk</td>
    </tr>
    <tr>
      <td>_</td>
      <td>underscore</td>
    </tr>
    <tr>
      <td>{ }</td>
      <td>curly braces</td>
    </tr>
    <tr>
      <td>[ ]</td>
      <td>brackets</td>
    </tr>
    <tr>
      <td>&lt; &gt;</td>
      <td>angle brackets</td>
    </tr>
    <tr>
      <td>( )</td>
      <td>parentheses</td>
    </tr>
    <tr>
      <td>#</td>
      <td>pound sign</td>
    </tr>
    <tr>
      <td>+</td>
      <td>plus sign</td>
    </tr>
    <tr>
      <td>-</td>
      <td>minus sign (hyphen)</td>
    </tr>
    <tr>
      <td>.</td>
      <td>dot</td>
    </tr>
    <tr>
      <td>!</td>
      <td>exclamation mark</td>
    </tr>
    <tr>
      <td>|</td>
      <td>pipe</td>
    </tr>
  </tbody>
</table>


## HTML

Many Markdown parsers allow you to use HTML tags in Markdown-formatted text. This is helpful if you prefer certain HTML tags to Markdown syntax. For example, some people find it easier to use HTML tags for images. Using HTML is also helpful when you need to change the attributes of an element, like specifying the color of text or changing the width of an image.

To use HTML, place the tags in the text of your Markdown-formatted file.

```html
This **word** is bold. This <em>word</em> is italic.
```

The rendered output looks like this:

This **word** is bold. This <em>word</em> is italic.


### Links

You can also use anchor tags.

```html
My favorite search engine is <a href="https://duckduckgo.com" target="_blank">Duck Duck Go</a>.
```

The rendered output looks like this:

My favorite search engine is <a href="https://duckduckgo.com" target="_blank">Duck Duck Go</a>.