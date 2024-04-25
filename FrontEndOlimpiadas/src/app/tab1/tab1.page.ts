import { Component, Inject } from '@angular/core';
import { IonHeader, IonToolbar, IonTitle, IonContent, IonNav, IonButton, IonRow, IonCol, IonGrid, IonCard, IonCardHeader, IonCardTitle, IonCardContent } from '@ionic/angular/standalone';
import { ExploreContainerComponent } from '../explore-container/explore-container.component';
import { Tab3Page } from '../tab3/tab3.page';
import { AuthButtonComponent } from '../auth-button/auth-button.component';
import { SpaceComponent } from '../space/space.component';




@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss'],
  standalone: true,
  imports: [IonCardContent, IonCardTitle, IonCardHeader, IonCard, IonGrid, IonHeader, IonToolbar, IonTitle, IonContent, ExploreContainerComponent, IonNav, IonButton, AuthButtonComponent, IonRow, IonCol, SpaceComponent]
})
export class Tab1Page {
  constructor() {
  }
  component = Tab3Page;
}
