import { Component } from '@angular/core';
import { IonHeader, IonToolbar, IonTitle, IonContent, IonNav } from '@ionic/angular/standalone';
import { ExploreContainerComponent } from '../explore-container/explore-container.component';
import { Tab3Page } from '../tab3/tab3.page';


@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss'],
  standalone: true,
  imports: [IonHeader, IonToolbar, IonTitle, IonContent, ExploreContainerComponent, IonNav]
})
export class Tab1Page {
  constructor() {}
  component = Tab3Page;
}
