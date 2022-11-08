import AppForm from '../app-components/Form/AppForm';

Vue.component('footer-link-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                footer_title_id:  '' ,
                link:  '' ,
                
            }
        }
    }

});