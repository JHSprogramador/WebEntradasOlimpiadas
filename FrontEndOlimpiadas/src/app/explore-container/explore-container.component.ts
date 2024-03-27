import { Component, Input } from '@angular/core';
import { IonHeader, IonToolbar, IonTitle } from "@ionic/angular/standalone";

@Component({
  selector: 'app-explore-container',
  templateUrl: './explore-container.component.html',
  styleUrls: ['./explore-container.component.scss'],
  imports: [IonHeader, IonToolbar, IonTitle],
  standalone: true,
})
export class ExploreContainerComponent {
  @Input() name?: string;
}
