import axios from 'axios'

export const state = {
  user: null,
  loggedIn: localStorage.getItem('loggedIn') || ''
}

export const getters = {
  user: state => state.user,
  loggedIn: state => state.loggedIn,
  check: state => state.user !== null
}

export const mutations = {
  setLoggedIn(state, payload) {
    state.loggedIn = payload
    localStorage.setItem('loggedIn', payload)
  }
}

export const actions = {
  async csrfCookie() {
    const { data } = await axios.get('/api/csrf-cookie')

    return data
  },

  login({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios
        .post('/login', payload)
        .then(({ data }) => {
          commit('setLoggedIn', 'true')
          resolve(data)
        })
        .catch(({ response }) => reject(response))
    })
  }
}
