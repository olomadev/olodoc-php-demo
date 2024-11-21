
## Olobase

Olobase is a integration-ready Open Source full featured framework designed to create fast and easy web applications with <a href="https://vuejs.org/" target="_blank">Vue.js</a> - <a href="https://www.php.net/" target="_blank">Php</a> technologies and also allows extensive customizations. It is built on <a href="https://vuetifyjs.com/en/" target="_blank">Vuetify</a> and runs on the backend REST API implementation Php <a href="https://docs.mezzio.dev/" target="_blank">Mezzio</a> Framework.

## Features

* Integration Ready <a href="https://vuejs.org" target="_blank">Vue.js</a> / <a href="https://vuetifyjs.com" target="_blank">Vuetify.js</a> Components
* Mezzio <a href="https://olobase.dev/docs/latest/php-api/index.html" target="_blank">PHP Rest API</a> for Backend
* Built in <a href="https://olobase.dev/docs/latest/php-api/jwt-authentication.html" target="_blank">JWT Authentication</a>
* Built in Roles & Permission Management for <a href="https://olobase.dev/docs/latest/ui/authorization.html" target="_blank">Authorization</a>
* <a href="https://olobase.dev/docs/latest/ui/layouts/layouts.html" target="_blank">Layouts</a>
* <a href="https://olobase.dev/docs/latest/ui/plugins.html" target="_blank">Plugins</a>
* <a href="https://olobase.dev/docs/latest/ui/inputs.html">Input</a> and <a href="https://olobase.dev/docs/latest/ui/fields.html">Fields</a>
* <a href="https://olobase.dev/docs/latest/ui/data-providers.html">Data Providers</a>
* Built in <a href="https://olobase.dev/docs/latest/ui/layouts/list.html">Data Grid and Colum Filters</a>
* <a href="https://olobase.dev/docs/latest/ui/i18n.html">i18n</a> Support
* <a href="https://olobase.dev/docs/latest/ui/authentication.html">Authentication</a> Providers
* <a href="https://olobase.dev/docs/latest/ui/resources.html">Resource</a> Management
* Community and Ticket Support

## Technologies

The following technologies were used in the development of Olobase.

* <a href="https://vuejs.org" target="_blank">Vue.js</a>
* <a href="https://vuetifyjs.com" target="_blank">Vuetify.js</a>
* <a href="https://zircote.github.io/swagger-php/" target="_blank">Open Api (Swagger-Php)</a>
* <a href="https://docs.mezzio.dev/" target="_blank">Mezzio Framework</a>
* <a href="https://olobase.dev/docs/latest/php-api/jwt-authentication.html" target="_blank">Jwt Authentication</a>
* <a href="https://getcomposer.org/" target="_blank">Composer</a>
* <a href="https://www.php.net/" target="_blank">Php 8</a>
* <a href="https://redis.io/" target="_blank">Redis</a>

## How Is It Working ?

Olobase uses an adapter approach with a concept called Data-providers. Existing providers can be used as a blueprint for designing your API, or you can write your own Data Provider to query an existing API. Writing a custom Data Provider will typically take you an hour or two. If you are using the existing JSON service provider, you do not need to write a data provider.

![Olobase Flow](/images/va-flow.jpg)

<div class="table-responsive">
<table class="table">
	<tbody>
		<tr>
			<td><b>Olobase Admin</b></td>
			<td>The admin resource generator converts resources in CRUD object creates Vue Routes and Vuex modules.</td>
		</tr>
		<tr>
			<td><b>Vue Router</b></td>
			<td>Creates and redirects to CRUD pages using Va (Olobase Admin) components and API resources objects.</td>
		</tr>
		<tr>
			<td><b>Olobase (Va) Components</b></td>
			<td>They are general components that recognize contextual resources (Layout, Page, Input, Data-Table, Field, SelectField ..)</td>
		</tr>
		<tr>
			<td><b>Resources</b></td>
			<td>Simple JS source array consists of descriptive objects (application modules like users, employees, companies, departments)</td>
		</tr>
		<tr>
			<td><b>Vuex</b></td>
			<td>The authorization provider and modules are defined on the <a href="https://vuex.vuejs.org/" target="_blank">Vuex</a> component.</td>
		</tr>
		<tr>
			<td><b>Data Provider</b></td>
			<td>Allows bridging between source modules and your backend API ensuring compatibility within Olobase Admin.</td>
		</tr>
		<tr>
			<td><b>Server API</b></td>
			<td>Your backend software written in PHP or other languages.</td>
		</tr>
	</tbody>
</table>
</div>

## In Summary

Olobase receives resources as objects within the application and will then point to your CRUD pages and <a href="https://vuex.vuejs.org/" target="_blank">Vuex</a> modules which will call your implemented data provider methods converts them to valid paths.

All internal Olobase components will be aware of the actual context relative to the current route and use the adapted source module to fetch or save to the API via the data provider, which acts as the compatibility layer between the Olobase and your API. As a result, this model requires much less boilerplate code to make CRUD work, increasing your coding speed.