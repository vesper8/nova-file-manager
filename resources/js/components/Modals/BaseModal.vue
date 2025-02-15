<template>
  <TransitionRoot :show="isOpen" as="template" class="nova-file-manager">
    <Dialog as="div" class="relative z-[60]" style="z-index: 999" @close="closeModal">
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-gray-800/20 backdrop-blur-sm transition-opacity" />
      </TransitionChild>
      <div :class="{ dark }" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end sm:items-center justify-center min-h-full p-0 md:p-4">
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <slot :close="closeModal" :is-open="isOpen" :dark="dark"></slot>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { Dialog, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { computed, onBeforeUnmount } from 'vue'
import { useStore } from '@/store'

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
})

onBeforeUnmount(() => {
  if (isOpen.value) {
    closeModal()
  }
})

const store = useStore()

const dark = computed(() => store.dark)
const isOpen = computed(() => store.isOpen(props.name))

const closeModal = () => {
  store.closeModal({ name: props.name })
}
</script>
