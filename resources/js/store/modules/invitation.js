import axios from 'axios'

export const state = {
  invitation: '',
  invitations: []
}

export const getters = {
  invitation: state => state.invitation,
  invitations: state => state.invitations
}

export const mutations = {
  setInvitation(state, payload) {
    state.invitation = payload
  },

  setInvitations(state, payload) {
    state.invitations = payload
  }
}

export const actions = {
  store(_, payload) {
    return new Promise((resolve, reject) => {
      axios
        .post('/api/invitations', payload)
        .then(({ data }) => resolve(data))
        .catch(({ response }) => reject(response))
    })
  },

  validate({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios
        .post('/api/invitations/validate', payload)
        .then(({ data }) => {
          const { data: invitation } = data
          commit('setInvitation', invitation)
          resolve(data)
        })
        .catch(({ response }) => reject(response))
    })
  }
}
