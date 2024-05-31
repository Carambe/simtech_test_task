<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Добавить тестовый товар в корзину и проверить, что это правильный товар');

// Задаем URL магазина Shopify
$shopUrl = 'https://e815bd-4e.myshopify.com';

//Временный пароль для входа в магазин с пробнной версией
$password = '11111';

// Задаем селекторы
$addToCartButtonSelector = 'button[name="add"]';
$cartItemSelector = '.cart__items';
$expectedProductName = "Red flower (test product)";
$expectedProductSelector = "//div[contains(@class, 'cart__item')][contains(., '$expectedProductName')]";

// Переход на страницу авторизации пользователя
$I->amOnPage($shopUrl . '/password');

// Авторизация с временным паролем
$I->fillField('password','11111');
$I->click('commit');
$I->see('Flower Test Shop');

// Переход на страницу товара
$I->amOnPage($shopUrl . '/products/red-flower-test-product');
$I->see('Red flower (test product)');

//Добавляем в корзину товар
$I->click($addToCartButtonSelector);

// Переходим в корзину
$I->amOnPage($shopUrl . '/cart');

// Проверяем, что товар добавлен в корзину
$I->seeElement($cartItemSelector);

// Проверяем, что в корзине находится именно тот товар, который мы добавили
$I->seeElement($expectedProductSelector);
