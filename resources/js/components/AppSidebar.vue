<script setup lang="ts">
import type { SidebarProps } from '@/components/ui/sidebar'

import {
  AudioWaveform,
  BookOpen,
  Bot,
  Command,
  Frame,
  GalleryVerticalEnd,
  Map,
  PieChart,
  Settings2,
  SquareTerminal,
} from "lucide-vue-next"
import NavMain from '@/components/NavMain.vue'
import NavProjects from '@/components/NavProjects.vue'
import NavUser from '@/components/NavUser.vue'
import TeamSwitcher from '@/components/TeamSwitcher.vue'

import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarRail,
} from '@/components/ui/sidebar'

const props = withDefaults(defineProps<SidebarProps>(), {
  collapsible: "icon",
})

// This is sample data.
const data = {
  teams: [
    {
      name: "Acme Inc",
      logo: GalleryVerticalEnd,
      plan: "Enterprise",
    },
    {
      name: "Acme Corp.",
      logo: AudioWaveform,
      plan: "Startup",
    },
    {
      name: "Evil Corp.",
      logo: Command,
      plan: "Free",
    },
  ],
  navMain: [
    {
      title: "Dashboards",
      icon: SquareTerminal,
      route: "#",
      isActive: true,
      items: [
        { title: "Dashboard", route: "dashboard" },               
        { title: "Dashboard 2", route: "dashboard2" },
        { title: "Dashboard 3", route: "dashboard3" },  
      ],
    },
    {
      title: "Beispielseiten",
      icon: Bot,
      items: [
        { title: "Beispielseite 1", route: "beispielseite1" },
        { title: "Beispielseite 2", route: "beispielseite2" },
        { title: "Beispielseite 3", route: "beispielseite3" },
      ],
    },
    {
      title: "Einstellungen",
      icon: Settings2,
      items: [
        { title: "Profileinstellungen", route: "profile.edit" },   
      ],
    },
  ],
  projects: [
    { name: "Projekt 1", icon: Frame, route: "project1" },
    { name: "Projekt 2", icon: PieChart, route: "project2" },
    { name: "Projekt 3", icon: Map, route: "project3" },
  ],
}
</script>

<template>
  <Sidebar v-bind="props">
    <SidebarHeader>
      <TeamSwitcher :teams="data.teams" />
    </SidebarHeader>
    <SidebarContent>
      <NavMain :items="data.navMain" />
      <NavProjects :projects="data.projects" />
    </SidebarContent>
    <SidebarFooter>
      <NavUser :user="data.user" />
    </SidebarFooter>
    <SidebarRail />
  </Sidebar>
</template>
