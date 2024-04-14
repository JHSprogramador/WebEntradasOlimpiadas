import { Component, EnvironmentInjector, inject } from '@angular/core';
import { IonTabs, IonTabBar, IonTabButton, IonIcon, IonLabel } from '@ionic/angular/standalone';
import { addIcons } from 'ionicons';
import { home, ellipse, person } from 'ionicons/icons';

@Component({
  selector: 'app-tabs',
  templateUrl: 'tabs.page.html',
  styleUrls: ['tabs.page.scss'],
  standalone: true,
  imports: [IonTabs, IonTabBar, IonTabButton, IonIcon, IonLabel],
})
export class TabsPage {
  public environmentInjector = inject(EnvironmentInjector);
  public isLogued: boolean = true;
  constructor() {
    addIcons({ home, ellipse, person });
  }

  // islogued(event: Event){
  //   if(!this.isLogued){
  //     event.preventDefault();
  //     alert("Debes loaguarte primero para ver tu perfil");
  //   }
  // }
}
