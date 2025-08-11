<script setup lang="ts">
import type { LucideIcon } from "lucide-vue-next"
import { ChevronRight } from "lucide-vue-next"
import { Link } from "@inertiajs/vue3"

import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from '@/components/ui/collapsible'
import {
  SidebarGroup,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarMenuSub,
  SidebarMenuSubButton,
  SidebarMenuSubItem,
} from '@/components/ui/sidebar'

type SubItem = {
  title: string
  route?: string   // benannter Laravel-Route-Name
  href?: string    // externe URL
}

type Item = {
  title: string
  icon?: LucideIcon
  isActive?: boolean
  route?: string
  href?: string
  items?: SubItem[]
}

const props = defineProps<{ items: Item[] }>()

// Helper: aktiver Zustand für Parent/Sub
const isRouteCurrent = (name?: string) => (name ? route().current(name) : false)
const isItemActive = (item: Item) =>
  (item.route && isRouteCurrent(item.route)) ||
  (item.items?.some(sub => sub.route && isRouteCurrent(sub.route)) ?? false)
</script>

<template>
  <SidebarGroup>
    <SidebarGroupLabel>Platform</SidebarGroupLabel>

    <SidebarMenu>
      <template v-for="item in props.items" :key="item.title">
        <!-- mit SubItems -->
        <Collapsible
          v-if="item.items?.length"
          as-child
          :default-open="isItemActive(item) || item.isActive"
          class="group/collapsible"
        >
          <SidebarMenuItem>
            <CollapsibleTrigger as-child>
              <SidebarMenuButton
                :tooltip="item.title"
                :is-active="isItemActive(item)"
              >
                <component :is="item.icon" v-if="item.icon" />
                <span>{{ item.title }}</span>
                <ChevronRight
                  class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90"
                />
              </SidebarMenuButton>
            </CollapsibleTrigger>

            <CollapsibleContent>
              <SidebarMenuSub>
                <SidebarMenuSubItem v-for="sub in item.items" :key="sub.title">
                  <SidebarMenuSubButton
                    as-child
                    :is-active="isRouteCurrent(sub.route)"
                  >
                    <!-- interne Route -->
                    <Link v-if="sub.route" :href="route(sub.route)" prefetch>
                      <span>{{ sub.title }}</span>
                    </Link>
                    <!-- externe URL -->
                    <a v-else :href="sub.href" target="_blank" rel="noopener">
                      <span>{{ sub.title }}</span>
                    </a>
                  </SidebarMenuSubButton>
                </SidebarMenuSubItem>
              </SidebarMenuSub>
            </CollapsibleContent>
          </SidebarMenuItem>
        </Collapsible>

        <!-- ohne SubItems -->
        <SidebarMenuItem v-else>
          <SidebarMenuButton
            as-child
            :tooltip="item.title"
            :is-active="isRouteCurrent(item.route)"
          >
            <Link v-if="item.route" :href="route(item.route)" prefetch>
              <component :is="item.icon" v-if="item.icon" />
              <span>{{ item.title }}</span>
            </Link>
            <a v-else :href="item.href">
              <component :is="item.icon" v-if="item.icon" />
              <span>{{ item.title }}</span>
            </a>
          </SidebarMenuButton>
        </SidebarMenuItem>
      </template>
    </SidebarMenu>
  </SidebarGroup>
</template>
