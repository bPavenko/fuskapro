import AppForm from '../app-components/Form/AppForm';

Vue.component('user-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                balance:  '' ,
                password:  '' ,
                surname:  '' ,
                phone:  '' ,
                city:  '' ,
                type_id:  '' ,
                
            }
        }
    }

});