
# Overview

Almost all Markdown implementations support the basic syntax outlined in the original Markdown design document. Below we have listed the .md syntaxes that are compatible with Olodoc.

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

```
> Dorothy followed her through many of the beautiful rooms in her castle.
```

The rendered output looks like this:

> Dorothy followed her through many of the beautiful rooms in her castle.

### Blockquotes with Multiple Paragraphs

Blockquotes can contain multiple paragraphs. Add a > on the blank lines between the paragraphs.

```
> Dorothy followed her through many of the beautiful rooms in her castle.
>
> The Witch bade her clean the pots and kettles and sweep the floor and keep the fire fed with wood.
```

The rendered output looks like this:

Dorothy followed her through many of the beautiful rooms in her castle.

The Witch bade her clean the pots and kettles and sweep the floor and keep the fire fed with wood.

### Nested Blockquotes

Blockquotes can be nested. Add a >> in front of the paragraph you want to nest.

```
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

```
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

```
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

```
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

Code blocks are normally indented four spaces or one tab. When they’re in a list, indent them eight spaces or two tabs.

```
1. Open the file.
2. Find the following code block on line 21:

        <html>
          <head>
            <title>Test</title>
          </head>

3. Update the title to match the name of your website.
```

The rendered output looks like this:

1. Open the file.
2. Find the following code block on line 21:

        <html>
          <head>
            <title>Test</title>
          </head>

3. Update the title to match the name of your website.


#### Images

```
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

```
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

## Code

To denote a word or phrase as code, enclose it in 3 backticks (```).

<code>
\```php <br>
echo "Hello World !"<br>
\```
</code>

The rendered output looks like this:

```php 
echo "Hello World !"
```

### Escaping Backticks

If the word or phrase you want to denote as code includes one or more backticks, you can escape it by enclosing the word or phrase in double backticks (``).

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
      <td><code>``Use `code` in your Markdown file.``</code></td>
      <td><code>&lt;code&gt;Use `code` in your Markdown file.&lt;/code&gt;</code></td>
      <td><code>Use `code` in your Markdown file.</code></td>
    </tr>
  </tbody>
</table>

### Language Coloring

If you want the code you wrote to be colored in any language, specify the code in lower case letters immediately after the back tick like below the format.

> \```<b>lang</b>

Example:

<code>
\```json <br>
{
<br>&nbsp;&nbsp;"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9........","<br>
&nbsp;&nbsp;"user": {<br>
&nbsp;&nbsp;&nbsp;&nbsp;"id": "21615870-4f89-4ab8-b91e-af6370a3089e",<br>
&nbsp;&nbsp;&nbsp;&nbsp;"firstname": "Demo",<br>
&nbsp;&nbsp;&nbsp;&nbsp;"lastname": "Admin",<br>
&nbsp;&nbsp;&nbsp;&nbsp;"email": "demo@example.com",<br>
&nbsp;&nbsp;&nbsp;&nbsp;"roles": [<br>
&nbsp;&nbsp;&nbsp;&nbsp;"admin"<br>
&nbsp;&nbsp;&nbsp;&nbsp;]<br>
&nbsp;&nbsp;},<br>
&nbsp;&nbsp;"expiresAt": "2022-08-03 11:58:22"<br>
}<br>
\```
</code>

The rendered output looks like this:

```json 
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9........",
    "user": {
        "id": "21615870-4f89-4ab8-b91e-af6370a3089e",
        "firstname": "Demo",
        "lastname": "Admin",
        "email": "demo@example.com",
        "roles": [
            "admin"
        ]
    },
    "expiresAt": "2022-08-03 11:58:22"
}
```

### Marking Line Numbers

To mark your line number use below the format.

> \```lang <b>[line-numbers] data-line="n"</b>

Example:

<code>
\```php [line-numbers] data-line="3"<br>
$companies = [<br>
&nbsp;&nbsp;JwtAuthenticationMiddleware::class,<br>
&nbsp;&nbsp;Mezzio\Authorization\AuthorizationMiddleware::class,<br>
&nbsp;&nbsp;App\Handler\Api\CompanyHandler::class<br>
];<br>
$app->route('/api/companies/create', $companies, ['POST']);<br>
$app->route('/api/companies/update/:companyId', $companies, ['PUT']);<br>
$app->route('/api/companies/delete/:companyId', $companies, ['DELETE']);<br>
$app->route('/api/companies/findAll', $companies, ['GET']);<br>
$app->route('/api/companies/findAllByPaging',$companies, ['GET']);<br>
$app->route('/api/companies/findOneById/:companyId', $companies, ['GET']);<br>
\```
</code>

The rendered output looks like this:

```php [line-numbers] data-line="3"
$companies = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
    App\Handler\Api\CompanyHandler::class
];
$app->route('/api/companies/create', $companies, ['POST']);
$app->route('/api/companies/update/:companyId', $companies, ['PUT']);
$app->route('/api/companies/delete/:companyId', $companies, ['DELETE']);
$app->route('/api/companies/findAll', $companies, ['GET']);
$app->route('/api/companies/findAllByPaging',$companies, ['GET']);
$app->route('/api/companies/findOneById/:companyId', $companies, ['GET']);
```

### Command Line

To mark your coding example is a command line use below the format.

> \```lang <b>[command-line] data-user="root" data-host="localhost"</b>

Example:

<code>
\```bash [command-line] data-user="root" data-host="localhost"<br>
git clone --branch 1.3.1 git@github.com:olomadev/olobase-skeleton-php.git example-php<br>
\```
</code>

The rendered output looks like this:

```bash [command-line] data-user="root" data-host="localhost"
git clone --branch 1.3.1 git@github.com:olomadev/olobase-skeleton-php.git example-php
```

## Alerts

Note:

> [!NOTE]
> Useful information that users should know, even when skimming content.

Tip:

> [!TIP]
> Helpful advice for doing things better or more easily.

Important:

> [!IMPORTANT]
> Key information users need to know to achieve their goal.

Warning:

> [!WARNING]
> Urgent info that needs immediate user attention to avoid problems.

Caution:

> [!CAUTION]
> Advises about risks or negative outcomes of certain actions.