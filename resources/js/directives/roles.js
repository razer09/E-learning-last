import store from '../store/index.js';

export default {
  inserted: function (el, binding) {
    console.log('directive :'+ binding.value);
    if(store.getters.roles.indexOf(binding.value) == -1 && binding.value != 'true'){
        el.remove();
    }
  }
}
