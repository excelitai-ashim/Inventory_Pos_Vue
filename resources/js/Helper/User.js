import Token from './Token'
import AppStorage from './AppStorage'

class User{
     responseAfterLogin(res){
        const access_token=res.data.access_token
        const name=res.data.name

        if(Token.isValid(access_token)){

            AppStorage.store(access_token,name)

        }

     }

     hasToken(){
        const storeToken=localStorage.getItem('token');
        if(storeToken){
         return Token.isValid(storeToken) ? true :false
        }
        return false;
    }

    loggedin(){
        return this.hasToken()
    }

    logout(){
        AppStorage.clear()
        this.$router.push({name: '/'})

    }

    name(){
        if(this.loggedin()){
          return localStorage.getItem('user')
        }
    }

    id(){
        if(this.loggedin()){
            const payload=Token.payload(localStorage.getItem('token'))
            return payload.sub
        }
        return false
    }

}

export default User=new User();