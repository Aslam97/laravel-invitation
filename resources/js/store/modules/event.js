import axios from 'axios'

export const state = {
  event: '',
  events: []
}

export const getters = {
  event: state => state.event,
  events: state => state.events
}

export const mutations = {
  setEvent(state, payload) {
    state.event = payload
  },

  setEvents(state, payload) {
    state.events = payload
  }
}

export const actions = {
  async index({ commit }) {
    const { data } = await axios.get('/api/events')
    commit('setEvents', data)
  },

  async show({ commit }, id) {
    const { data } = await axios.get(`/api/events/${id}`)
    commit('setEvent', data)
  }
}
