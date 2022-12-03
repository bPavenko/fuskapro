import AppForm from '../app-components/Form/AppForm';

Vue.component('applications-link-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                url:  '' ,
                
            }
        }
    }

});