// require('./bootstrap');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import NovaWeb from './NovaWeb'

Vue.config.productionTip = false

;(function () {
    this.CreateNovaWeb = function(config) {
        return new NovaWeb(config)
    }
}.call(window))
