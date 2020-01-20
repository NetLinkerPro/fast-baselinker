<?php


namespace NetLinker\FastBaselinker\Methods;


class MethodBaselinker
{

    /*
    |--------------------------------------------------------------------------
    | STORAGE
    |--------------------------------------------------------------------------
    */

    const GET_STORAGES_LIST = 'getStoragesList';

    const ADD_CATEGORY = 'addCategory';

    const ADD_PRODUCT = 'addProduct';

    const ADD_PRODUCT_VARIANT = 'addProductVariant';

    const DELETE_CATEGORY = 'deleteCategory';

    const DELETE_PRODUCT = 'deleteProduct';

    const DELETE_PRODUCT_VARIANT = 'deleteProductVariant';

    const GET_CATEGORIES = 'getCategories';

    const GET_PRODUCTS_DATA = 'getProductsData';

    const GET_PRODUCTS_LIST = 'getProductsList';

    const GET_PRODUCTS_QUANTITY = 'getProductsQuantity';

    const GET_PRODUCTS_PRICES = 'getProductsPrices';

    const UPDATE_PRODUCTS_QUANTITY = 'updateProductsQuantity';

    const UPDATE_PRODUCTS_PRICES = 'updateProductsPrices';

    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */

    const GET_JOURNAL_LIST = 'getJournalList';

    const ADD_ORDER = 'addOrder';

    const GET_ORDERS = 'getOrders';

   const GET_ORDERS_BY_EMAIL = 'getOrdersByEmail';

    const GET_ORDERS_BY_PHONE = 'getOrdersByPhone';

    const GET_INVOICES = 'getInvoices';

    const GET_ORDER_STATUS_LIST = 'getOrderStatusList';

    const GET_ORDER_PAYMENTS_HISTORY = 'getOrderPaymentsHistory';

    const GET_NEW_RECEIPTS = 'getNewReceipts';

    const SET_ORDER_FIELDS = 'setOrderFields';

    const ADD_ORDER_PRODUCT = 'addOrderProduct';

    const SET_ORDER_PRODUCT_FIELDS = 'setOrderProductFields';

    const DELETE_ORDER_PRODUCT = 'deleteOrderProduct';

    const SET_ORDER_PAYMENT = 'setOrderPayment';

    const SET_ORDER_STATUS = 'setOrderStatus';

    const SET_ORDER_RECEIPT = 'setOrderReceipt';


    /*
    |--------------------------------------------------------------------------
    | COURIERS
    |--------------------------------------------------------------------------
    */

    const CREATE_PACKAGE = 'createPackage';

    const CREATE_PACKAGE_MANUAL = 'createPackageManual';

    const GET_COURIERS_LIST = 'getCouriersList';

    const GET_COURIER_FIELDS = 'getCourierFields';

    const GET_COURIER_SERVICES = 'getCourierServices';

    const GET_COURIER_ACCOUNTS = 'getCourierAccounts';

    const GET_LABEL = 'getLabel';

    const GET_ORDER_PACKAGES = 'getOrderPackages';

    const GET_COURIER_PACKAGES_STATUS_HISTORY = 'getCourierPackagesStatusHistory';

}