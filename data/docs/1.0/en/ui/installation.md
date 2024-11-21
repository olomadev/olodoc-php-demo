
## Setup

To install the framework, the <b>Node.js</b> package must be installed on your computer.

### Requirements

Only Node.js 18.15.0 and above are supported, check out the article below to install <b>Node.js</b> with <b>Nvm</b> in your environment.

* <a href="https://medium.com/@ersin.guvenc/node-js-installation-with-nvm-manager-on-ubuntu-22-04-lts-for-olobase-development-de6f5542c78e" target="_blank">How to Install Node.js with Nvm manager on Ubuntu 22-04 LTS</a>

Follow the steps below to create an Olobase frontend project.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
git clone --branch 1.3.2 git@github.com:olomadev/olobase-skeleton-ui myproject
```

Go to your project root

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
cd /var/www/myproject
```

Initalize the <b>olobase-admin</b> submodule

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
git submodule update --init
```

Install node modules with <b>npm</b>.

```bash
npm i 
```

### .env Files

Save the <kbd>env.dist</kbd> file in the root directory as <kbd>.env.dev</kbd>.

> Your env file should start with "." prefix. Otherwise, the application cannot load the environment file and you will get an error.

.env.dev file content

```sh
VITE_DEFAULT_LOCALE=en
VITE_FALLBACK_LOCALE=en
VITE_SUPPORTED_LOCALES=en,tr
VITE_API_URL=http://example.local/api
VITE_HCAPTCHA_SITE_KEY=
VITE_SESSION_UPDATE_TIME=5
VITE_COOKIE={ "token": "_token", "user": "_user" }
```

If the env file name is incorrect, you will receive the error: <b>"translation.js:13 Uncaught TypeError: Cannot read properties of undefined (reading 'split')".</b>

### Vite.config.js

The <kbd>server.host</kbd> address value of the vite configuration should always remain <b>0.0.0.0</b> by default. This value means that the server is open to listening on all host addresses, whether you are working with a local or virtual server such as <a href="https://www.vmware.com/" target="_blank">VMWare</a>. Because of this every IP address entered points to your application.

```js
export default defineConfig({
  // transpileDependencies: true,
  transpileDependencies: ["vuetify"],
  server: {
    host: '0.0.0.0',
    port: 3000 // the port number you want
  },
  plugins: [ ...
```

### Starting Your Local Server

Starts the application in the local environment.

```bash
npm run dev
```

If you are working on a local computer, you can visit http://127.0.0.1:3000. If you are working on a local virtual server, you can type the IP address of your server into your browser and visit an IP address like in this example; http://192.168.231.129:3000.

### Exporting the Project

With this command, your javascript files compiled for the production environment are exported to the <kbd>/dist</kbd> folder.

```bash
npm run build
```

### Getting Updates

When you set up the project as above, <a href="https://github.com/olomadev/olobase-admin" target="_blank">olobase-admin</a> is included in your project as a submodule. 

```sh
- myproject
  + packages
    - admin   // (olobase-admin submodule)
      + src
        .git
        EULA.md
        package.json
        README.md
  + src
    .env.dev
    .gitignore
    .gitmodules
    app.css
    env.dist
    favicon.ico
    index.html
    package.json
    README.md
    vite.config.js
```

You can keep your olobase application up to date by upgrading this package to new versions. To do this, look at the releases on the <a href="https://github.com/olomadev/olobase-admin/releases" target="_blank">releases</a> address. And follow the steps below to install the updated version.

```sh
cd /var/www/myproject
````

Enter the <b>packages/admin</b> folder within the current folder.

```sh
cd packages/admin
```

Upgrade your <b>olobase-admin</b> submodule to the latest version.

```sh
git pull origin 1.3.5
```

Don't forget to follow the versions of your <a href="https://github.com/olomadev/olobase-admin" target="_blank">olobase-admin</a> submodule to keep your application 
up to date.

### Did You Edit The Submodule ?

If you did some changes in your <a href="https://github.com/olomadev/olobase-admin" target="_blank">olobase-admin</a> submodule folder (accidently or for test purposes etc.) you need use stash command before the pull operation.

Do stash & pull

```sh
cd packages/admin

git stash
git pull origin 1.3.5
```

### Still Didn't Work ?

If you still cannot get the update you want after trying the commands above, try to run the commands below.

```sh
git restore .
// HEAD detached at 1.2.0

git pull origin 1.3.5
git checkout 1.3.5
```