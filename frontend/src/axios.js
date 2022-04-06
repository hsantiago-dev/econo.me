import axios from 'axios'

const instance = axios.create({

    baseURL: 'http://econo.me/api'
})

export default instance