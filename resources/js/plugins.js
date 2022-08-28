// plugins/i18n.js
export default {
    install: (app, options) => {
      app.config.globalProperties.$checkFileString = function(key){

        let conditions = ['http://', 'https://', 'www.']

        if(key){
          for (let index = 0; index < conditions.length; index++) {
              if(key.indexOf(conditions[index]) !== -1){
                  return key
              }
              
          }
        }

        return window.location.origin + key

      }
    }
  }