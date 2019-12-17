/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');// CommonJS
import * as CanvasJs from './canvasjs.min';


window.Vue = require('vue');
import JQuery from 'jquery'
let $ = JQuery;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


let categories;



window.onclick = function(event) {
    if (event.target === $('#payment-methods-add-modal-bg')[0]) {
        $('#payment-methods-add-modal-bg').hide();
    }
    if (event.target === $('#home_add_transaction_modal')[0]) {
        $("#home_add_transaction_modal").hide();
    }
}

let home_add_transaction_accounting = new Vue({
    el: '#home-add-transaction-accounting'
});

new Vue({
    el: '#payment-methods-section',
    methods: {
        payment_methods_add_btn_clicked: function(){
            $('#payment-methods-add-modal-bg').show();
        }
    }
});
let home_section = new Vue({
    el: '#home_section',
    data() {
        // csrf_token: null,
        // categoryByAccountingRoute: null,
        // categories: null,
        return{
            categories: [],
            csrf_token: null,
            categoryByAccountingRoute: null
        }
    },
    methods: {
        home_add_transaction_btn: function (balance_id) {
            $("#home_add_transaction_balance").val(balance_id);
            $("#home_add_transaction_modal").show();
        },
        loadcategories(csrfToken, route){
            let self = this;
            console.log("loadCategories");
            let id = $('#home-add-transaction-accounting').val();
            $.ajax({
                url: route,
                data: {
                    '_token': csrfToken,
                    'id': id
                },
                type: 'get',
                dataType: 'json',
                async: false,
                success: (result) => {
                    // let categories = new Array();
                    $.each( result, function(k, val){
                        $.each(val, function(key, v){
                            if(!(k in self.categories)){
                                self.categories[k] = []
                            }
                            self.categories[k].push( [v['id'], v['name']] );
                        })
                    })
                    this.home_accounting_select_changed();
                    return this.categories;
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    console.log("errorMessage");
                }
            })
        },
        home_accounting_select_changed: function () {
            let self = this;
            let id = $('#home-add-transaction-accounting').val();
            $('#home_add_transaction_category option').remove();
            $.each( self.categories[id], function (k, cname) {
                $('#home_add_transaction_category').append($('<option>').val(cname[0]).text(cname[1]));
            })
        },
        collapse_btn_clicked: function(id){
            $('.home-trnsctn-table-'+id).first().toggle();
        }
    },
    mounted(){
        this.csrf_token = this.$el.getAttribute('data-csrf');
        this.categoryByAccountingRoute = this.$el.getAttribute('data-category-by-acc');
        this.categories = new Array();
        this.loadcategories(this.csrf_token, this.categoryByAccountingRoute);
        this.$on('changeSelect', () => {
            this.home_accounting_select_changed();
        });
        try {
            let selectaddtrnsctnacc = document.getElementById('home-add-transaction-accounting');

            selectaddtrnsctnacc.addEventListener('change', () => {
                home_section.$emit('changeSelect');
            });
        }catch (e) {
            console.log(e)
        }
    }
});


let statistics_section = new Vue({
    el: '#statistics_section',
    date() {
        return {
            gstatisticsRoute: null,
            sstatisticsRoute: null,
            csrf_token: null
        }
    },
    methods: {
        makeChart: function (dataPoints, title) {
            console.log(dataPoints);

            let chartIncome = new CanvasJs.Chart('statistics-container-income', {
                animationEnabled: true,
                title: {
                    text: title+" Income"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: dataPoints[0]
                }]
            });

            chartIncome.render();

            let chartExpense = new CanvasJs.Chart('statistics-container-expense', {
                animationEnabled: true,
                title: {
                    text: title+" Expense"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: dataPoints[1]
                }]
            });

            chartExpense.render();
        },
        gstats: function(){
            $.ajax({
                url: this.gstatisticsRoute,
                data: {
                    '_token': this.csrf_token
                },
                type: 'get',
                dataType: 'json',
                async: true,
                success: (result) => {
                    this.makeChart(result, 'General Statistics')
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    console.log("errorMessage");
                }
            })
        },
        changePM: function () {
            var self = this;
            if($('#PMSelect').val() != 0) {
                $.ajax({
                    url: this.sstatisticsRoute,
                    data: {
                        '_token': this.csrf_token,
                        'id': $('#PMSelect').val()
                    },
                    type: 'get',
                    dataType: 'json',
                    async: true,
                    success: (result) => {
                        this.makeChart(result, 'Specific Statistics')
                    },
                    error: function (jqXhr, textStatus, errorMessage) { // error callback
                        console.log("errorMessage");
                    }
                })
            }else{
                this.gstats();
            }
        }
    },
    mounted() {
        this.gstatisticsRoute = this.$el.getAttribute('data-gstatisctics-route');
        this.sstatisticsRoute = this.$el.getAttribute('data-sstatisctics-route');
        this.csrf_token = this.$el.getAttribute('data-csrf');
        this.gstats();
    }
})

$('.nav-hide-show').first().click(function(){
    $('nav').toggle();
})
