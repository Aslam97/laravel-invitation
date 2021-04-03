import axios from 'axios'

export const state = {}

export const getters = {}

export const mutations = {}

export const actions = {
  async index({ commit }) {
    const { data } = await axios.get('/api/events')
    commit('setEvents', data)
  },

  store(_, payload) {
    return new Promise((resolve, reject) => {
      axios
        .post('/api/invitations', payload)
        .then(({ data }) => resolve(data))
        .catch(({ response }) => reject(response))
    })
  }
}
