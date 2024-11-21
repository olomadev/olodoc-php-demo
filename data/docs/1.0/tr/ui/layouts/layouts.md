
## Layoutlar

Ana layout, diğer adı <b>VaLayout</b>, burada gösterildiği gibi farklı bölgelerden oluşur:

![Login](/images/layout.jpg)

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Slot</th>
         <th>Varsayılan Va Bileşeni</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>appbar</strong></td>
         <td><kbd>VaAppBar</kbd></td>
         <td>Ana uygulama çubuğunu oluşturur, çoğunlukla bir <a href="https://vuetifyjs.com/en/components/app-bars/" target="blank">VAppBar</a>. Ana kenar çubuğu aslında bir <a href="https://vuetifyjs.com/en/components/navigation-drawers/" target="_blank">VNavigationDrawer</a>'dır.</td>
      </tr>
      <tr>
         <td><strong>header</strong></td>
         <td><kbd>VaBreadcrumbs</kbd></td>
         <td><a href="https://vuetifyjs.com/en/components/breadcrumbs/" target="_blank">VBreadcrumbs</a> veya herhangi bir özel uyarı için olan sayfa tepesindeki alanı oluşturur.</td>
      </tr>
      <tr>
         <td><strong>default</strong></td>
         <td>-</td>
         <td>Tüm CRUD sayfaları veya kimliği doğrulanmış herhangi bir özel sayfa burada gösterilir.</td>
      </tr>
      <tr>
         <td><strong>logo</strong></td>
         <td>-</td>
         <td>Logo olarak planladığınız imaj ya da text bu slot içinde gösterilmelidir.</td>
      </tr>
      <tr>
         <td><strong>avatar</strong></td>
         <td>-</td>
         <td>Son kullanıcı avatar resmi için bu slot kullanılmalıdır.</td>
      </tr>
      <tr>
         <td><strong>profile</strong></td>
         <td>-</td>
         <td>Son kullanıcıya ait ad, soyad, email gibi profil menüsüne ait içereikler için bu slot kullanılmalıdır.</td>
      </tr>
      <tr>
         <td><strong>aside</strong></td>
         <td><kbd>VaAside</kbd></td>
         <td>İçeriğin yanı sıra, bağlamsallaştırılmış ek bilgiler için bu alan kullanılır.</td>
      </tr>
      <tr>
         <td><strong>footer</strong></td>
         <td><kbd>VaFooter</kbd></td>
         <td>Bu alan <a href="https://vuetifyjs.com/en/components/footers/" target="_blank">VFooter</a> bileşeni içinde bazı kurumsal bilgilerin gösterilmesini sağlayan altbilgi alanıdır.</td>
      </tr>
   </tbody>
</table>
</div>