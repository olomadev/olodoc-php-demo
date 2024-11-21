
## Environments

Create <b>.env.dev</b> and <b>.env.prod</b> files in the root directory by copying the contents of the <b>.env.dist</b> file.

### Local Environment Configuration

Vite <b>dev</b> environment configuration example;

```bash
VITE_DEFAULT_LOCALE=en
VITE_FALLBACK_LOCALE=en
VITE_SUPPORTED_LOCALES=en,tr
VITE_API_URL=http://example.local/api
VITE_HCAPTCHA_SITE_KEY=
VITE_SESSION_UPDATE_TIME=5
VITE_COOKIE={ "token": "_local_demo_token", "user": "_local_demo_user" }
```

### Production Environment Configuration

Vite <b>prod</b> environment configuration example;

```bash
VITE_DEFAULT_LOCALE=tr
VITE_FALLBACK_LOCALE=en
VITE_SUPPORTED_LOCALES=en,tr
VITE_API_URL=https://example.com/api
VITE_HCAPTCHA_SITE_KEY=
VITE_SESSION_UPDATE_TIME=5
VITE_COOKIE={ "token": "_demo_token", "user": "_demo_user" }
```

### How is It Working ?

The <b>dev</b> and <b>build</b> commands defined in your <b>package.json</b> file are defined for the environments we created above.

```json
"scripts": {
	"dev": "vite --host --mode dev",
	"build": "vite build --mode prod",
	"preview": "vite preview",
	"lint": "eslint --ext .js,.vue --ignore-path .gitignore --fix src"
},
```

Just go to the console and run <b>dev</b> for the development environment or <b>build</b> for output to the production environment.

### Dev

Starts the application in the local environment.

```bash
npm run dev
```

![npm run dev](/images/npm-run-dev.png)

If you are working on a local computer, you can type http://localhost:3000, or if you are working on a local virtual server, type the IP address of your server into your browser, such as http://192.168.231.129:3000, and visit your application. If you have created a virual domain name on your local, the address you will visit should be something like http://mydomain.local:3000.

### Build

With this command, your javascript files compiled for the production environment are exported to the <kbd>/dist</kbd> folder.

```bash
npm run build
```

At the last stage, all you have to do to make your application work is to copy the required files and publish them on your website.