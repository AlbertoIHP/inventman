class LocalStorageCredentialsService
{
  setCurrentUser (user)
  {
    localStorage.setItem('user', user)
  }
  getCurrentUser ()
  {
    let user = JSON.parse(localStorage.getItem('user'))
    return user
  }
  setToken (token)
  {
    localStorage.setItem('token', token)
  }
  getToken ()
  {
    let token = localStorage.getItem('token')
    return token
  }
  clearCredentials ()
  {
    localStorage.clear('user')
    localStorage.clear('token')
  }

}

export default LocalStorageCredentialsService
