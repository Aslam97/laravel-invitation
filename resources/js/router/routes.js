function loadView(path) {
  return () =>
    import(
      /* webpackChunkName: "[request]" */
      // /* webpackPrefetch: true */
      // /* webpackPreload: true */
      `@views/${path}`
    ).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: loadView('welcome.vue') },

  { path: '/login', name: 'login', component: loadView('auth/login.vue') },

  {
    path: '/register',
    name: 'register',
    component: loadView('auth/register.vue')
  },

  { path: '/home', name: 'home', component: loadView('home.vue') },

  {
    path: '/events/:id',
    name: 'events',
    component: loadView('event/show.vue')
  },

  { path: '*', component: loadView('errors/404.vue') }
]
