<?php

/**Week**/
$test = "SELECT MIN(o.created_date) AS date_start, MAX(o.created_date) AS date_end, COUNT(*) AS `no_of_orders`, SUM((SELECT SUM(op.quantity) FROM `orders_product` op WHERE op.order_id = o.id GROUP BY op.order_id)) AS products, SUM(o.total) AS `total` FROM `orders` o GROUP BY YEAR(o.created_date), WEEK(o.created_date) ORDER BY o.created_date DESC LIMIT 0, 20";


/**day**/
$test = "SELECT MIN(o.created_date) AS date_start, MAX(o.created_date) AS date_end, COUNT(*) AS `no_of_orders`, SUM((SELECT SUM(op.quantity) FROM `orders_product` op WHERE op.order_id = o.id GROUP BY op.order_id)) AS products, SUM(o.total) AS `total` FROM `orders` o GROUP BY YEAR(o.created_date), MONTH(o.created_date), DAY(o.created_date) ORDER BY o.created_date DESC LIMIT 0, 20";


/************Goraksha************/

/**Week**/
$test = "SELECT MIN(o.date_created) AS date_start, MAX(o.date_created) AS date_end, COUNT(*) AS `no_of_orders`, SUM((SELECT SUM(op.quantity) FROM `orders_product` op WHERE op.order_ref_id = o.order_ref_id GROUP BY op.order_ref_id)) AS products, SUM(o.total) AS `total` FROM `orders` o GROUP BY YEAR(o.date_created), WEEK(o.date_created) ORDER BY o.date_created DESC LIMIT 0, 20";

/**day**/
$test = "SELECT MIN(o.date_created) AS date_start, MAX(o.date_created) AS date_end, COUNT(*) AS `no_of_orders`, SUM((SELECT SUM(op.quantity) FROM `orders_product` op WHERE op.order_ref_id = o.order_ref_id GROUP BY op.order_ref_id)) AS products, SUM(o.total) AS `total` FROM `orders` o GROUP BY YEAR(o.date_created), MONTH(o.date_created), DAY(o.date_created) ORDER BY o.date_created DESC LIMIT 0, 20";


/**month**/
$test = "SELECT MIN(o.date_created) AS date_start, MAX(o.date_created) AS date_end, COUNT(*) AS `no_of_orders`, SUM((SELECT SUM(op.quantity) FROM `orders_product` op WHERE op.order_ref_id = o.order_ref_id GROUP BY op.order_ref_id)) AS products, SUM(o.total) AS `total` FROM `orders` o GROUP BY YEAR(o.date_created), MONTH(o.date_created) ORDER BY o.date_created DESC LIMIT 0, 20";


/**year**/
$test = "SELECT MIN(o.date_created) AS date_start, MAX(o.date_created) AS date_end, COUNT(*) AS `no_of_orders`, SUM((SELECT SUM(op.quantity) FROM `orders_product` op WHERE op.order_ref_id = o.order_ref_id GROUP BY op.order_ref_id)) AS products, SUM(o.total) AS `total` FROM `orders` o GROUP BY YEAR(o.date_created) ORDER BY o.date_created DESC LIMIT 0, 20";



o.order_id
o.date_added
o.total
op.quantity
op.order_id
ot.value
ot.order_id

orders_product

?>