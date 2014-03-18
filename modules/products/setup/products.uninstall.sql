/**
 * Completely removes products data
 */

DROP TABLE IF EXISTS `cot_products`;

DELETE FROM `cot_structure` WHERE structure_area = 'products';