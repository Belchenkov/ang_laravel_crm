import { Component, Input, OnInit, EventEmitter, Output } from '@angular/core';

import { Navigation } from "../../../models/navigation";

@Component({
  selector: 'app-navigation',
  templateUrl: './navigation.component.html',
  styleUrls: ['./navigation.component.scss']
})
export class NavigationComponent implements OnInit {
  @Input() navigation: Navigation[];
  @Output() sidenavToggle = new EventEmitter<void>();

  constructor() { }

  ngOnInit(): void {}

  onToggleSideNav(): void {
    this.sidenavToggle.emit();
  }

}
