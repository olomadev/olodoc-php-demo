
## Layouts

The main layout, also known as <b>VaLayout</b>, consists of different zones as shown here:

![Login](/images/layout.jpg)

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Slot</th>
         <th>Default VaComponent</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>appbar</strong></td>
         <td><kbd>VaAppBar</kbd></td>
         <td>It builds the app bar is most often a <a href="https://vuetifyjs.com/en/components/app-bars/" target="blank">VAppBar</a>. The main sidebar is essentially a <a href="https://vuetifyjs.com/en/components/navigation-drawers/" target="_blank">VNavigationDrawer</a>.</td>
      </tr>
      <tr>
         <td><strong>header</strong></td>
         <td><kbd>VaBreadcrumbs</kbd></td>
         <td>Creates the area at the top of the page for <a href="https://vuetifyjs.com/en/components/breadcrumbs/" target="_blank">VBreadcrumbs</a> or any custom alerts.</td>
      </tr>
      <tr>
         <td><strong>default</strong></td>
         <td>-</td>
         <td>All CRUD pages or any authenticated custom page will be shown here.</td>
      </tr>
      <tr>
         <td><strong>logo</strong></td>
         <td>-</td>
         <td>The image or text you planned as the logo is displayed in this slot.</td>
      </tr>
      <tr>
         <td><strong>avatar</strong></td>
         <td>-</td>
         <td>This slout should be used for the end user avatar image.</td>
      </tr>
      <tr>
         <td><strong>profile</strong></td>
         <td>-</td>
         <td>This slout should be used for profile menu content such as the end user's name, surname, and email.</td>
      </tr>
      <tr>
         <td><strong>aside</strong></td>
         <td><kbd>VaAside</kbd></td>
         <td>In addition to the content, this space is used for additional contextualized information.</td>
      </tr>
      <tr>
         <td><strong>footer</strong></td>
         <td><kbd>VaFooter</kbd></td>
         <td>This section is a footer area that allows displaying some corporate information in the <a href="https://vuetifyjs.com/en/components/footers /"target="_blank">VFooter</a> component.</td>
      </tr>
   </tbody>
</table>
</div>
