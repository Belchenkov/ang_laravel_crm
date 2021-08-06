import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';

import { Navigation } from "../../../models/navigation";

@Component({
  selector: 'app-sidenav-list',
  templateUrl: './sidenav-list.component.html',
  styleUrls: ['./sidenav-list.component.scss']
})
export class SidenavListComponent implements OnInit {
  @Input() navigation: Navigation[];
  @Output() sidenavClose = new EventEmitter<void>();

  constructor() { }

  ngOnInit(): void {
  }

  onSideNavClose(): void {
    this.sidenavClose.emit();
  }

}
