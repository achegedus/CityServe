/**
 * Created by adamh on 12/9/16.
 */

export const apiDomain = 'http://localhost:8888/';
export const loginUrl = apiDomain + 'oauth/token';
export const userUrl = apiDomain + 'api/user';


export const getHeader = function() {
    const tokenData = JSON.parse(window.localStorage.getItem('authUser'))
    const headers = {
        'Accept' : 'application/json',
        'Authorization' : 'Bearer ' + tokenData.access_token
    }

    return headers
}