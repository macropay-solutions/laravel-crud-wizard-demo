## Laravel 9 demo for laravel-crud-wizard package 

See [laravel-crud-wizard](https://github.com/macropay-solutions/laravel-lumen-crud-wizard) for more info.

## License

[MIT license](https://opensource.org/licenses/MIT).

Changes required for the first resource:
![image](https://github.com/macropay-solutions/laravel-crud-wizard-demo/assets/153634237/56705141-2975-471e-8969-62df78067839)
With green are the changes needed for a new resource (except ResourceController).

If someone is interested in testing it, pls contact us https://macropay.net/contact/ for a bearer token.

Here are exposed the resources with their relations: http://89.40.19.34/laravel-lumen-crud-wizard

Test endpoint: http://89.40.19.34/laravel-9/api/{resource} or /laravel-10/

ex http://89.40.19.34/laravel-9/api/operations?mins[]=created_at

PS. HEADER: Accept application/xls generates a binary xls file for download (with relations in different sheets).

Examples:

http://89.40.19.34/laravel-9/api/operations?mins[]=value&limit=1&relationsFilters[products][value][from]=21&doesntHaveRelations[]=products

```
{
    "sums": {
        "value": null
    },
    "avgs": {
        "value_avg": null
    },
    "mins": {
        "value_min": "10.00"
    },
    "maxs": {
        "value_max": null,
        "created_at_max": null
    },
    "index_required_on_filtering": [
        "id",
        "parent_id",
        "client_id",
        "created_at",
        "currency",
        "value"
    ],
    "DEMO_ONLY_sql_debugger": [
        "select count(*) as aggregate from `operations` where `operations`.`id` not in (select `x`.`operation_id` from `operations_products_pivot` as `x` inner join `products` on `x`.`product_id` = `products`.`id` where `products`.`value` >= '21')",
        "select * from `operations` where `operations`.`id` not in (select `x`.`operation_id` from `operations_products_pivot` as `x` inner join `products` on `x`.`product_id` = `products`.`id` where `products`.`value` >= '21') order by `created_at` desc limit 1 offset 0",
        "select distinct `products`.*, `operations_products_pivot`.`operation_id` as `laravel_through_key` from `products` inner join `operations_products_pivot` on `operations_products_pivot`.`product_id` = `products`.`id` where `operations_products_pivot`.`operation_id` in (3748918) and `products`.`value` >= '21'",
        "select MIN(`operations`.`value`) as value_min from `operations` where `operations`.`id` not in (select `x`.`operation_id` from `operations_products_pivot` as `x` inner join `products` on `x`.`product_id` = `products`.`id` where `products`.`value` >= '21')"
    ],
    "current_page": 1,
    "data": [
        {
            "id": 3748918,
            "parent_id": null,
            "client_id": 68378,
            "currency": "EUR",
            "value": "27.00",
            "created_at": "2024-01-17 11:04:57",
            "updated_at": null,
            "primary_key_identifier": "3748918",
            "products": []
        }
    ],
    "from": 1,
    "last_page": 3286782,
    "per_page": 1,
    "to": 1,
    "total": 3286782
}
```

http://89.40.19.34/laravel-9/api/operations/1/products?aggregates[groupBys][]=id&mins[]=value

```
{
    "sums": {
        "value": null
    },
    "avgs": {
        "value_avg": null
    },
    "mins": {
        "value_min": "10.00"
    },
    "maxs": {
        "value_max": null
    },
    "index_required_on_filtering": [
        "id",
        "created_at",
        "value",
        "currency",
        "code",
        "ean",
        "name"
    ],
    "aggregated_total_count": 1,
    "DEMO_ONLY_sql_debugger": [
        "select * from `operations` where (`id` = '1') limit 1",
        "select `products`.*, `operations_products_pivot`.`operation_id` as `laravel_through_key` from `products` inner join `operations_products_pivot` on `operations_products_pivot`.`product_id` = `products`.`id` where `operations_products_pivot`.`operation_id` = 1 limit 1",
        "select `operations`.*, `operations_products_pivot`.`product_id` as `laravel_through_key` from `operations` inner join `operations_products_pivot` on `operations_products_pivot`.`operation_id` = `operations`.`id` where `operations_products_pivot`.`product_id` = 1 limit 1",
        "select count(*) as aggregate from (select SUM(`products`.`value`) as value, AVG(`products`.`value`) as value_avg, MIN(`products`.`value`) as value_min, MAX(`products`.`value`) as value_max, COUNT(DISTINCT `products`.`id`) as group_count, `products`.`id` as id from `products` where `products`.`id` in (select `x`.`product_id` from `operations_products_pivot` as `x` inner join `operations` on `x`.`operation_id` = `operations`.`id` where `operations`.`id` = 1) group by `id`) as `aggregate_table`",
        "select SUM(`products`.`value`) as value, AVG(`products`.`value`) as value_avg, MIN(`products`.`value`) as value_min, MAX(`products`.`value`) as value_max, COUNT(DISTINCT `products`.`id`) as group_count, `products`.`id` as id from `products` where `products`.`id` in (select `x`.`product_id` from `operations_products_pivot` as `x` inner join `operations` on `x`.`operation_id` = `operations`.`id` where `operations`.`id` = 1) group by `id` order by `created_at` desc limit 10 offset 0",
        "select `operations`.*, `operations_products_pivot`.`product_id` as `laravel_through_key` from `operations` inner join `operations_products_pivot` on `operations_products_pivot`.`operation_id` = `operations`.`id` where `operations_products_pivot`.`product_id` = 1 limit 1",
        "select MIN(`products`.`value`) as value_min from `products` where `products`.`id` in (select `x`.`product_id` from `operations_products_pivot` as `x` inner join `operations` on `x`.`operation_id` = `operations`.`id` where `operations`.`id` = 1)",
        "select count(*) as aggregate from `products` where `products`.`id` in (select `x`.`product_id` from `operations_products_pivot` as `x` inner join `operations` on `x`.`operation_id` = `operations`.`id` where `operations`.`id` = 1)"
    ],
    "current_page": 1,
    "data": [
        {
            "value": "10.00",
            "value_avg": "10.000000",
            "value_min": "10.00",
            "value_max": "10.00",
            "group_count": 1,
            "id": 1
        }
    ],
    "from": 1,
    "last_page": 1,
    "per_page": 10,
    "to": 1,
    "total": 1
}
```

http://89.40.19.34/laravel-9/api/operations?limit=3&parent_id[o]=isNull&parent_id[v][]=1&parent_id[v][]=2&sort[0][by]=parent_id

```
{
    "sums": {
        "value": null
    },
    "avgs": {
        "value_avg": null
    },
    "mins": {
        "value_min": null,
        "created_at_min": null
    },
    "maxs": {
        "value_max": null,
        "created_at_max": null
    },
    "index_required_on_filtering": [
        "id",
        "parent_id",
        "client_id",
        "created_at",
        "currency",
        "value"
    ],
    "DEMO_ONLY_sql_debugger": [
        "select count(*) as aggregate from `operations` where (`operations`.`parent_id` in ('1', '2') or `operations`.`parent_id` is null)",
        "select * from `operations` where (`operations`.`parent_id` in ('1', '2') or `operations`.`parent_id` is null) order by `parent_id` desc limit 3 offset 0"
    ],
    "current_page": 1,
    "data": [
        {
            "id": 3,
            "parent_id": 2,
            "client_id": 2,
            "currency": "EUR",
            "value": "10.05",
            "created_at": "2024-01-12 19:31:53",
            "updated_at": null,
            "primary_key_identifier": "3"
        },
        {
            "id": 2,
            "parent_id": 1,
            "client_id": 2,
            "currency": "EUR",
            "value": "10.01",
            "created_at": "2024-01-12 19:25:51",
            "updated_at": null,
            "primary_key_identifier": "2"
        },
        {
            "id": 1,
            "parent_id": null,
            "client_id": 1,
            "currency": "EUR",
            "value": "10.00",
            "created_at": "2024-01-03 19:39:02",
            "updated_at": null,
            "primary_key_identifier": "1"
        }
    ],
    "from": 1,
    "last_page": 1249640,
    "per_page": 3,
    "to": 3,
    "total": 3748918
}
```
http://89.40.19.34/laravel-9/api/operations?limit=3&parent_id[o]=isNotNull
```
{
    "sums": {
        "value": null
    },
    "avgs": {
        "value_avg": null
    },
    "mins": {
        "value_min": null,
        "created_at_min": null
    },
    "maxs": {
        "value_max": null,
        "created_at_max": null
    },
    "index_required_on_filtering": [
        "id",
        "parent_id",
        "client_id",
        "created_at",
        "currency",
        "value"
    ],
    "DEMO_ONLY_sql_debugger": [
        "select count(*) as aggregate from `operations` where `operations`.`parent_id` is not null",
        "select * from `operations` where `operations`.`parent_id` is not null order by `created_at` desc limit 3 offset 0"
    ],
    "current_page": 1,
    "data": [
        {
            "id": 3,
            "parent_id": 2,
            "client_id": 2,
            "currency": "EUR",
            "value": "10.05",
            "created_at": "2024-01-12 19:31:53",
            "updated_at": null,
            "primary_key_identifier": "3"
        },
        {
            "id": 2,
            "parent_id": 1,
            "client_id": 2,
            "currency": "EUR",
            "value": "10.01",
            "created_at": "2024-01-12 19:25:51",
            "updated_at": null,
            "primary_key_identifier": "2"
        }
    ],
    "from": 1,
    "last_page": 1,
    "per_page": 3,
    "to": 2,
    "total": 2
}
```



