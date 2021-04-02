<script>
export default {
  layout: 'welcome',

  meta: {
    title: 'HuntBazaar'
  }
}
</script>

<template>
  <div :class="$style.page">
    <div :class="$style.page_content">
      <h1 :class="$style.page_title">
        HuntBazaar
      </h1>
    </div>
  </div>
</template>

<style lang="scss" module>
.page {
  background-color: #fd6a65;
  margin: 0px auto;
  width: 100%;
  height: 100%;
  transition: max-width 0.5s ease 0s;
  display: flex;
  align-items: center;

  &_content {
    margin: 0px auto;
    width: 100%;
    max-width: 690px;
    transition: max-width 0.5s ease 0s;
  }

  &_title {
    color: #fff;
    font-size: 2.6rem;
    font-weight: 600;
    text-align: center;
  }
}
</style>
