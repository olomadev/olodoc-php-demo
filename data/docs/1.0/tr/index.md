
## Olobase

Olobase, <a href="https://vuejs.org/" target="_blank">Vue.js</a> - <a href="https://www.php.net/" target="_blank">Php</a> ile hızlı ve kolay web uygulamaları oluşturmak için tasarlanmış, entegrasyona hazır, Açık Kaynak, tam özellikli bir çerçevedir. Geçerli en son teknolojilerine sahiptir ve aynı zamanda kapsamlı özelleştirmelere de olanak tanır. <a href="https://vuetifyjs.com/en/" target="_blank">Vuetify</a> üzerine kuruludur ve arka uç REST API uygulaması olarak Php <a href="https://docs üzerinde çalışır .mezzio.dev/" target="_blank">Mezzio</a> çerçevesini kullanır.

## Özellikler

* Entegrasyona Hazır <a href="https://vuejs.org" target="_blank">Vue.js</a> / <a href="https://vuetifyjs.com" target="_blank">Vuetify .js</a> Bileşenleri
* Arka Uç için Mezzio <a href="https://olobase.dev/docs/latest/php-api/index.html" target="_blank">PHP Rest API</a>
* Yerleşik <a href="https://olobase.dev/docs/latest/php-api/jwt-authentication.html" target="_blank">JWT Kimlik Doğrulaması</a>
* <a href="https://olobase.dev/docs/latest/ui/authorization.html" target="_blank">Yetkilendirme</a> için Yerleşik Roller ve İzin Yönetimi
* <a href="https://olobase.dev/docs/latest/ui/layouts/layouts.html" target="_blank">Layoutlar</a>
* <a href="https://olobase.dev/docs/latest/ui/plugins.html" target="_blank">Eklentiler</a>
* <a href="https://olobase.dev/docs/latest/ui/inputs.html">Input</a> ve <a href="https://olobase.dev/docs/latest/ui/ fields.html">Alanlar</a>
* <a href="https://olobase.dev/docs/latest/ui/data-providers.html">Veri Sağlayıcılar</a>
* Dahili <a href="https://olobase.dev/docs/latest/ui/layouts/list.html">Data Grid ve Sütun Filtreleri</a>
* <a href="https://olobase.dev/docs/latest/ui/i18n.html">i18n</a> Desteği
* <a href="https://olobase.dev/docs/latest/ui/authentication.html">Kimlik Doğrulama</a> Sağlayıcıları
* <a href="https://olobase.dev/docs/latest/ui/resources.html">Kaynak</a> Yönetimi
* Topluluk ve Biletli Destek

## Teknolojiler

Olobase'in geliştirilmesinde aşağıdaki teknolojiler kullanıldı.

* <a href="https://vuejs.org" target="_blank">Vue.js</a>
* <a href="https://vuetifyjs.com" target="_blank">Vuetify.js</a>
* <a href="https://zircote.github.io/swagger-php/" target="_blank">Open Api (Swagger-Php)</a>
* <a href="https://docs.mezzio.dev/" target="_blank">Mezzio Framework</a>
* <a href="https://olobase.dev/docs/latest/php-api/jwt-authentication.html" target="_blank">Jwt Authentication</a>
* <a href="https://getcomposer.org/" target="_blank">Composer</a>
* <a href="https://www.php.net/" target="_blank">Php 8</a>
* <a href="https://redis.io/" target="_blank">Redis</a>

## Nasıl Çalışıyor ?

Olobase, Veri Sağlayıcılar (data-providers) adlı bir kavramla bir adaptör yaklaşımı kullanır. Mevcut sağlayıcılar, API'nizi tasarlamak için bir plan olarak kullanılabilir veya mevcut bir API'yi sorgulamak için kendi Veri Sağlayıcınızı yazabilirsiniz. Özel bir Veri Sağlayıcıyı yazmak ortalama bir veya iki saatinizi alacak bir zamandır. Eğer mevcut JSON servis sağlayıcısını kullanıyorsanız veri sağlayıcı da yazmanıza gerek kalmaz.

![Olobase Flow](/images/va-flow.jpg)

<div class="table-responsive">
<table class="table">
	<tbody>
		<tr>
			<td><b>Olobase Admin</b></td>
			<td>Yönetim panelinizin kaynak oluşturucusu, CRUD'da kaynakları dönüştürme nesnesi Vue Rotaları ve Vuex modüllerini oluşturur.</td>
		</tr>
		<tr>
			<td><b>Vue Router</b></td>
			<td>Olobase Admin (Va) bileşenleri ve API kaynakları nesnelerini kullanan CRUD sayfalarını oluşturur ve bu sayfalara yönlendirme işlemlerini gerçekleştirir.</td>
		</tr>
		<tr>
			<td><b>Olobase (Va) Bileşenleri</b></td>
			<td>Bağlamsal kaynakları tanıyan genel bileşenlerdir (Layout, Page, Input, Data-Table, Field, SelectField ..).</td>
		</tr>
		<tr>
			<td><b>Resources</b></td>
			<td>Basit JS kaynak dizisi tanımlayıcı nesnelerden oluşur (users, employees, companies, departments gibi uygulama modülleri).</td>
		</tr>
		<tr>
			<td><b>Vuex</b></td>
			<td>Yetkinlendirme sağlayıcısı ve modüller <a href="https://vuex.vuejs.org/" target="_blank">Vuex</a> bileşeni üzerinde tanımlanır.</td>
		</tr>
		<tr>
			<td><b>Data Provider</b></td>
			<td>Olobase Admin içinde uyumluluğu sağlayan kaynak modülleri ve arka uç API'niz arasında köprü kurmayı sağlar.</td>
		</tr>
		<tr>
			<td><b>Server API</b></td>
			<td>Php ya da başka diller de yazılmış arka uç yazılımınız.</td>
		</tr>
	</tbody>
</table>
</div>

## Özetle

Olobase, uygulama içinde kaynakları (resources) nesne olarak alır ve ardından uygulanan veri sağlayıcı yöntemlerinizi çağıracak olan CRUD sayfalarınıza ve <a href="https://vuex.vuejs.org/" target="_blank">Vuex</a> modüllerinize işaret edecek geçerli yollar olarak dönüştürür.

Tüm dahili Olobase bileşenleri, geçerli rotaya göre gerçek bağlamdan haberdar olacak ve Olobase ile API'niz arasında uyumluluk katmanı görevi gören veri sağlayıcı aracılığıyla API'ye getirmek veya API'ye kaydetmek için uyarlanmış kaynak (resource) modülünü kullanacaktır. Sonuç olarak, bu model, CRUD'ın çalışmasını sağlamak için çok daha az standart koda ihtiyaç duyulmasını sağlar ve kod yazma hızınızı artmış olur.