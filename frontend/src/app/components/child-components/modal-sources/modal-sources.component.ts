import { Component, EventEmitter, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-modal-sources',
  templateUrl: './modal-sources.component.html',
  styleUrls: ['./modal-sources.component.scss']
})
export class ModalSourcesComponent implements OnInit {
  @Output() onChange = new EventEmitter();

  constructor() { }

  ngOnInit(): void {
  }

}
