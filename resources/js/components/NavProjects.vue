<script setup lang="ts">
import type { LucideIcon } from "lucide-vue-next"
import { Link } from "@inertiajs/vue3"
import { Folder, Forward, MoreHorizontal, Trash2 } from "lucide-vue-next"

import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import {
  SidebarGroup,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuAction,
  SidebarMenuButton,
  SidebarMenuItem,
  useSidebar,
} from '@/components/ui/sidebar'

defineProps<{
  projects: {
    name: string
    icon: LucideIcon
    route: string     // <- benannter Laravel-Route-Name (project1, project2, …)
  }[]
}>()

const { isMobile } = useSidebar()
</script>

<template>
  <SidebarGroup class="group-data-[collapsible=icon]:hidden">
    <SidebarGroupLabel>Projects</SidebarGroupLabel>

    <SidebarMenu>
      <SidebarMenuItem v-for="item in projects" :key="item.name">
        <SidebarMenuButton as-child :is-active="route().current(item.route)">
          <Link :href="route(item.route)" prefetch>
            <component :is="item.icon" />
            <span>{{ item.name }}</span>
          </Link>
        </SidebarMenuButton>

        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <SidebarMenuAction show-on-hover>
              <MoreHorizontal />
              <span class="sr-only">More</span>
            </SidebarMenuAction>
          </DropdownMenuTrigger>

          <DropdownMenuContent
            class="w-48 rounded-lg"
            :side="isMobile ? 'bottom' : 'right'"
            :align="isMobile ? 'end' : 'start'"
          >
            <DropdownMenuItem :as-child="true">
              <Link :href="route(item.route)" prefetch class="flex items-center gap-2">
                <Folder class="text-muted-foreground" />
                <span>View Project</span>
              </Link>
            </DropdownMenuItem>

            <DropdownMenuItem :as-child="true">
              <Link :href="route(item.route)" prefetch class="flex items-center gap-2">
                <Forward class="text-muted-foreground" />
                <span>Share Project</span>
              </Link>
            </DropdownMenuItem>

            <DropdownMenuSeparator />

            <DropdownMenuItem>
              <Trash2 class="text-muted-foreground" />
              <span>Delete Project</span>
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      </SidebarMenuItem>

      <!-- "More" bleibt optional ohne Link -->
      <SidebarMenuItem>
        <SidebarMenuButton class="text-sidebar-foreground/70">
          <MoreHorizontal class="text-sidebar-foreground/70" />
          <span>More</span>
        </SidebarMenuButton>
      </SidebarMenuItem>
    </SidebarMenu>
  </SidebarGroup>
</template>
