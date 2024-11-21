
## Kurulum

Çerçeve kurulumu için <b>Node.js</b> paketi bilgisayarınızda kurulu olmalıdır.

### Gereksinimler

Sadece Node.js 18.15.0 ve üzeri sürümler desteklenir, çalışma ortamınıza <b>Nvm</b> ile <b>Node.js</b>'i yüklemek için aşağıdaki makaleye gözatın.

* <a href="https://medium.com/@ersin.guvenc/node-js-installation-with-nvm-manager-on-ubuntu-22-04-lts-for-olobase-development-de6f5542c78e" target="_blank">Ubuntu-22-04 üzerinde Nvm yöneticisi ile Node.js nasıl kurulur ?</a>

Bir Olobase önyüz projesi yaratmak için aşağıdaki adımları izleyin.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
git clone --branch 1.3.2 git@github.com:olomadev/olobase-skeleton-ui myproject
```

Projenizin kök klasörüne gidin

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
cd /var/www/myproject
```

<b>olobase-admin</b> alt modülünü etkinleştirin

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
git submodule update --init
```

<b>Npm</b> ile node modüllerini yükleyin.

```bash
npm i 
```

### .env Dosyaları

Kök dizindeki <kbd>env.dist</kbd> dosyasını <kbd>.env.dev</kbd> olarak kaydedin.

> Ortam dosyanız "." önekiyle başlamalıdır, aksi takdirde uygulama ortam dosyasını yükleyemez ve hata alırsınız.

.env.dev dosyası içeriği

```sh
VITE_DEFAULT_LOCALE=en
VITE_FALLBACK_LOCALE=en
VITE_SUPPORTED_LOCALES=en,tr
VITE_API_URL=http://example.local/api
VITE_HCAPTCHA_SITE_KEY=
VITE_SESSION_UPDATE_TIME=5
VITE_COOKIE={ "token": "_token", "user": "_user" }
```

Env dosyası ismi yanlış ise alacağınız hata: <b>"translation.js:13 Uncaught TypeError: Cannot read properties of undefined (reading 'split')" hatasını alırsınız.</b>

### Vite.config.js

Vit yapılandırmasının <kbd>server.host</kbd> adres değeri varsayılan olarak her zaman <b>0.0.0.0</b> olarak kalmalıdır. Bu değer, yerel veya <a href = "https://www.vmware.com/" target = "_blank">VMWare</a> gibi sanal bir sunucuyla çalışıyor olsanız bile, sunucunun tüm ana bilgisayar adreslerini dinlemeye açık olduğu anlamına gelir. Böylece girilen her IP adresi uygulamanızı işaret eder.

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

### Yerel Sunucunuzu Başlatma

Yerel ortamda uygulamayı başlatır.

```bash
npm run dev
```

Yerel bir bilgisayarda çalışıyorsanız http://127.0.0.1:3000 adresini ziyaret edebilirsiniz. Eğer yerel bir sanal sunucu üzerinde çalışıyorsanız, tarayıcınıza sunucunuzun IP adresini yazıp bu örnekteki gibi bir IP adresini ziyaret edebilirsiniz; http://192.168.231.129:3000.

### Projeyi İhraç Etmek

Bu komut ile produksiyon ortamı için derlenen javascript dosyalarınız <kbd>/dist</kbd> klasörü altına ihraç edilir.

```bash
npm run build
```

### Güncellemeleri Almak

Projeyi yukarıdaki gibi kurduğunuzda <a href="https://github.com/olomadev/olobase-admin" target="_blank">olobase-admin</a> projenize submodule olarak dahil olur.

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

Bu paketi yeni sürümlere yükselterek olobase uygulamanızın güncel kalmasını sağlayabilirsiniz. Bunu yapmak için <a href="https://github.com/olomadev/olobase-admin/releases" target="_blank">sürümler</a> adresindeki sürümleri takip edin. Ve güncel sürümü yüklemek için aşağıdaki adımları izleyin.

```sh
cd /var/www/myproject
````

Mevcut klasör içinde <b>packages/admin</b> klasörüne girin.

```sh
cd packages/admin
```

<b>olobase-admin</b> alt uygulamanızı güncel sürüme yükseltin.

```sh
git pull origin 1.3.5
```

Uygulamanızın güncel kalması için <a href="https://github.com/olomadev/olobase-admin" target="_blank">olobase-admin</a> submodülünüze ait sürümleri takip etmeyi unutmayın.

### Alt Modülde Düzenleme mi Yaptınız ?

Eğer <a href="https://github.com/olomadev/olobase-admin" target="_blank">olobase-admin</a> alt modülünüzde bazı değişiklikler yaptıysanız (yanlışlıkla veya test amaçlı vb.), pull komutundan önce (stash) yani yapılan değişiklikleri geçersiz kıl komutunu kullanmanız gerekir.

Değişikliklerden vazgeç (stash) ve ilgili versiyon için çek (pull) yapın.

```sh
cd packages/admin

git stash
git pull origin 1.3.5
```

### Yukarıdaki Komutlar İşe Yaramadı mı ?

Yukarıdaki komutları denediğiniz halde hâlâ istediğiniz güncellemeyi alamadıysanız aşağıdaki komutları çalıştırmayı deneyin.

```sh
git restore .
// HEAD detached at 1.2.0

git pull origin 1.3.5
git checkout 1.3.5
```
