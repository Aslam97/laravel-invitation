<script>
export default {
  props: {
    value: {
      type: [String, Number],
      default: ''
    },
    rules: {
      type: [String, Object],
      default: ''
    },
    name: {
      type: String,
      default: ''
    },
    placeholder: {
      type: String,
      default: ''
    },
    vid: {
      type: String,
      default: undefined
    },
    type: {
      type: String,
      default: 'text'
    },
    label: {
      type: Boolean,
      default: false
    },
    autocomplete: {
      type: String,
      default: ''
    },
    disabled: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    currentValue: ''
  }),
  computed: {
    isRequired() {
      if (this.rules.includes('required')) return true
      return false
    }
  },
  watch: {
    value: {
      handler(after) {
        this.currentValue = after
      },
      immediate: true
    }
  },
  methods: {
    handleInput() {
      this.$emit('input', this.currentValue)
    }
  }
}
</script>

<template>
  <ValidationProvider
    v-slot="{ errors }"
    tag="div"
    :class="$style.form_group"
    :rules="rules"
    :name="name"
    :vid="vid"
  >
    <label
      v-if="label"
      :for="name"
      :class="$style.form_label"
    >
      {{ name }}
      <!-- <span
        v-if="isRequired"
        :class="$style.form_required"
      >*</span> -->
    </label>

    <input
      :id="name"
      v-model="currentValue"
      :type="type"
      :class="[$style.form_control, { [$style.is_invalid]: errors[0] }]"
      :placeholder="placeholder"
      :autocomplete="autocomplete"
      :disabled="disabled"
      @input="handleInput"
    >
    <span :class="$style.invalid_feedback">{{ errors[0] }}</span>

    <small :class="$style.form_help">
      <slot name="form-help" />
    </small>
  </ValidationProvider>
</template>

<style lang="scss" module>
.form_group {
  display: block;
  margin-bottom: 1rem;
}

.form_required {
  color: #ff5252;
  :after {
    content: ' ';
  }
}

.form_label {
  display: flex;
  align-items: center;
  margin-bottom: 0.5rem;
  color: var(--color-text-default);
  font-size: 0.9rem;
  font-weight: 600;
}

.form_control {
  background-color: transparent;
  border-radius: 4px;
  color: var(--color-input-text);
  font-size: 0.9rem;
  font-weight: 400;
  max-width: 100%;
  outline: 0;
  padding: 0.75rem 1rem;
  box-shadow: inset 0 0 4px rgb(0 0 0 / 6%);
  width: 100%;
  min-height: 2.75rem;
  border: 1px solid var(--color-border);
  transition: all 0.15s ease 0s;

  &:focus {
    border-left: 3px solid var(--color-primary);
  }

  &.is_invalid {
    border-color: var(--color-error);
  }

  &.is_invalid ~ .invalid_feedback {
    display: block;
  }
}

.invalid_feedback {
  display: none;
  width: 100%;
  margin-top: 2px;
  font-size: 0.8rem;
  line-height: 1rem;
  color: var(--color-error);
}

.form_help {
  color: rgba(0, 0, 0, 0.54);
  font-size: 0.875rem;
  margin-top: 1rem;
}
</style>
