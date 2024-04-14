import { Component, Inject } from '@angular/core';
import { IonHeader, IonToolbar, IonTitle, IonContent, IonButton } from '@ionic/angular/standalone';
import { ExploreContainerComponent } from '../explore-container/explore-container.component';
import { AuthService } from '@auth0/auth0-angular';
import { CommonModule, DOCUMENT } from '@angular/common';
import { ProfileInfoComponent } from '../profile-info/profile-info.component';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss'],
  standalone: true,
  imports: [IonButton, IonHeader, IonToolbar, IonTitle, IonContent, ExploreContainerComponent, CommonModule, ProfileInfoComponent],
})
export class Tab3Page {
  // isAuthenticated$ = this.auth.isAuthenticated$;
  // constructor(@Inject(DOCUMENT) public document: Document, public auth: AuthService) {}
  constructor() {}
}
