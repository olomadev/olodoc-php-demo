
## Ortamlar

<b>.env.dist</b> dosyasının içeriğini kopyalayarak <b>.env.dev</b> ve <b>.env.prod</b> dosyalarını kök dizinde oluşturun.

### Yerel Ortam Konfigürasyonu

Vite <b>dev</b> ortamı konfigürasyon örneği;

```bash
VITE_DEFAULT_LOCALE=en
VITE_FALLBACK_LOCALE=en
VITE_SUPPORTED_LOCALES=en,tr
VITE_API_URL=http://example.local/api
VITE_HCAPTCHA_SITE_KEY=
VITE_SESSION_UPDATE_TIME=5
VITE_COOKIE={ "token": "_local_demo_token", "user": "_local_demo_user" }
```

### Üretim Ortamı Konfigurasyonu

Vite <b>prod</b> ortamı konfigürasyon örneği;

```bash
VITE_DEFAULT_LOCALE=tr
VITE_FALLBACK_LOCALE=en
VITE_SUPPORTED_LOCALES=en,tr
VITE_API_URL=https://example.com/api
VITE_HCAPTCHA_SITE_KEY=
VITE_SESSION_UPDATE_TIME=5
VITE_COOKIE={ "token": "_demo_token", "user": "_demo_user" }
```

### Nasıl Çalışıyor ?

<b>package.json</b> dosyanızda tanımlı olan <b>dev</b> ve <b>build</b> komutları yukarıda oluşturduğumuz ortamlar için tanımlıdır.

```json
"scripts": {
	"dev": "vite --host --mode dev",
	"build": "vite build --mode prod",
	"preview": "vite preview",
	"lint": "eslint --ext .js,.vue --ignore-path .gitignore --fix src"
},
```

Sadece konsola gidin ve geliştirme ortamı için <b>dev</b>, prodüksiyon ortamına çıktı almak içinse <b>build</b> komutunu çalıştırın.

### Dev

Yerel ortamda uygulamayı başlatır.

```bash
npm run dev
```

![npm run dev](/images/npm-run-dev.png)

Yerel bir bilgisayarınızda çalışıyorsanız http://localhost:3000 adresini, eğer yerel sanal bir sunucu üzerinde çalışıyorsanız sunucunuzun IP adresini tarayıcınıza http://192.168.231.129:3000 gibi yazıp uygulamanızı ziyaret edebilirsiniz. Eğer yerel bir alan adı oluşturduysanız ziyaret edeceğiniz adres http://mydomain.local:3000 gibi bir adres olmalı.

### Build

Bu komut ile produksiyon ortamı için derlenen javascript dosyalarınız <kbd>/dist</kbd> klasörü altına ihraç edilir. 

```bash
npm run build
```

Son aşamada uygulamanızın çalışması için tek yapmanız gereken ihtaç edilen dosyaları kopyalayıp web sitenizde yayınlamak.