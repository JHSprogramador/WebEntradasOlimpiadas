import { Component, EnvironmentInjector, inject } from '@angular/core';
import { AuthService } from '@auth0/auth0-angular';
import { IonTabs, IonTabBar, IonTabButton, IonIcon, IonLabel } from '@ionic/angular/standalone';
import { addIcons } from 'ionicons';
import { home, person } from 'ionicons/icons';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-tabs',
  templateUrl: 'tabs.page.html',
  styleUrls: ['tabs.page.scss'],
  standalone: true,
  imports: [IonTabs, IonTabBar, IonTabButton, IonIcon, IonLabel, CommonModule],
})
export class TabsPage {
  public environmentInjector = inject(EnvironmentInjector);
  isAuthenticated$ = this.auth.isAuthenticated$;

  constructor(public auth: AuthService) {
    addIcons({ home, person });
  }
}
