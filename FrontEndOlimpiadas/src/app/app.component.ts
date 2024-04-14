import { Component } from '@angular/core';
import { IonApp, IonRouterOutlet, IonHeader, IonTitle, IonToolbar } from '@ionic/angular/standalone';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  standalone: true,
  imports: [IonToolbar, IonTitle, IonHeader, IonApp, IonRouterOutlet, IonHeader],
})
export class AppComponent {
  constructor() {}
}
