<template>
  <div class="container mt-4">
    <transition
      name="page"
      mode="out-in"
    >
      <slot>
        <RouterView />
      </slot>
    </transition>
  </div>
</template>
