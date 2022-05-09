import axios from 'axios'

const instance = axios.create({

    baseURL: 'http://econo.me'
})

export default instance