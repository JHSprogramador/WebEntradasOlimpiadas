import { Routes } from '@angular/router';
import { ProfileComponent } from './profile/profile.component';

export const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('./tabs/tabs.routes').then((m) => m.routes),
  },
  { path: "profile", component: ProfileComponent, pathMatch: "full" },
];
