

# Migration and DB seeder (after changing your DB settings in .env)
php artisan migrate --seed

# Install dependency with NPM 14
npm install

# develop
npm run dev # or npm run watch

# Build on production
npm run production
```

#### Docker
```sh
docker-compose up -d
```
Build static files within Laravel container with npm
```sh
# Get laravel docker container ID from containers list
docker ps

docker exec -it <container ID> npm run dev # or npm run watch
# Where <container ID> is the "laravel" container name, ex: src_laravel_1
```
Open http://localhost:8000 (laravel container port declared in `docker-compose.yml`) to access Laravue

## Running the tests
* Tests system is under development

## Deployment and/or CI/CD
This project uses [Envoy](https://laravel.com/docs/5.8/envoy) for deployment, and [GitLab CI/CD](https://about.gitlab.com/product/continuous-integration/). Please check `Envoy.blade.php` and `.gitlab-ci.yml` for more detail.

## Built with
* [Laravel](https://laravel.com/) - The PHP Framework For Web Artisans
* [Laravel Sanctum](https://github.com/laravel/sanctum/) - Laravel Sanctum provides a featherweight authentication system for SPAs and simple APIs.
* [spatie/laravel-permission](https://github.com/spatie/laravel-permission) - Associate users with permissions and roles.
* [VueJS](https://vuejs.org/) - The Progressive JavaScript Framework
* [Element](https://element.eleme.io/) - A  Vue 2.0 based component library for developers, designers and product managers
* [Vue Admin Template](https://github.com/PanJiaChen/vue-admin-template) - A minimal vue admin template with Element UI

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, please look at the [release tags](https://github.com/tuandm/laravue/tags) on this repository.

## Authors

* **Tuan Duong** - *Initial work* - [tuandm](https://github.com/tuandm).
* **Tony Tin Nguyen** - *Frontend and Designer* - [nguyenquangtin](https://github.com/nguyenquangtin).

See also the list of [contributors](https://github.com/tuandm/laravue/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details.

## Related projects

* [Laravue-core](https://github.com/tuandm/laravue-core) - Laravel package which provides core functionalities of Laravue.

## Acknowledgements

* [vue-element-admin](https://panjiachen.github.io/vue-element-admin/#/) A magical vue admin which insprited Laravue project.
* [tui.editor](https://github.com/nhnent/tui.editor) - Markdown WYSIWYG Editor.
* [Echarts](http://echarts.apache.org/) - A powerful, interactive charting and visualization library for browser.

## Donate
If you find this project useful, you can [buy me a coffee](https://www.buymeacoffee.com/tuandm)
